<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SesiGaming extends Model
{
    protected $table = 'sesi_gaming';
    protected $fillable = [
        'paket_id',
        'ps_id',
        'waktu_mulai',
        'waktu_selesai',
        'total_harga',
        'status',
        'tv_dimatikan',
        'respon_shutdown',
        'catatan'
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
        'total_harga' => 'decimal:2',
        'tv_dimatikan' => 'boolean'
    ];

    public function paket()
    {
        return $this->belongsTo(Paket::class, 'paket_id');
    }

    public function ps()
    {
        return $this->belongsTo(PS::class, 'ps_id');
    }

    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'selesai');
    }

    public function scopeHariIni($query)
    {
        return $query->whereDate('waktu_mulai', today());
    }

    public function isExpired(): bool
    {
        return $this->status === 'aktif' && now() >= $this->waktu_selesai;
    }

    public function getSisaMenit(): int
    {
        if ($this->status !== 'aktif') {
            return 0;
        }

        $sekarang = now();
        $waktuSelesai = $this->waktu_selesai;

        if ($sekarang >= $waktuSelesai) {
            return 0;
        }

        return $sekarang->diffInMinutes($waktuSelesai);
    }

    public function getSisaWaktuFormatted(): string
    {
        $sisaMenit = $this->getSisaMenit();
        
        if ($sisaMenit <= 0) {
            return 'HABIS';
        }

        if ($sisaMenit >= 60) {
            $jam = floor($sisaMenit / 60);
            $menit = $sisaMenit % 60;
            return $jam . 'j ' . $menit . 'm';
        }

        return $sisaMenit . ' menit';
    }

    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'aktif' => $this->isExpired() ? 'danger' : 'success',
            'selesai' => 'secondary',
            'batal' => 'warning',
            default => 'primary'
        };
    }

    public function getTotalHargaFormatted(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    public function getDurasiAktualMenit(): int
    {
        if ($this->status !== 'selesai') {
            return 0;
        }

        return $this->waktu_mulai->diffInMinutes($this->waktu_selesai);
    }

    public function isHampirHabis(): bool
    {
        return $this->status === 'aktif' && $this->getSisaMenit() <= 5 && $this->getSisaMenit() > 0;
    }
    public static function autoCompleteExpiredSessions(): int
    {
        $expiredSessions = self::with(['paket', 'ps'])
            ->where('status', 'aktif')
            ->where('waktu_selesai', '<=', now())
            ->get();

        $count = 0;
        foreach ($expiredSessions as $sesi) {
            $waktuSelesai = $sesi->waktu_mulai->copy()->addMinutes($sesi->paket->durasi_menit);

            $sesi->update([
                'status' => 'selesai',
                'tv_dimatikan' => true,
                'waktu_selesai' => $waktuSelesai
            ]);

            if ($sesi->ps && $sesi->ps->ip_tv) {
                self::shutdownTV($sesi->ps->nomor ?? "PS-{$sesi->ps->id}", $sesi->ps->ip_tv);
            }
            $count++;
        }

        return $count;
    }

    private static function shutdownTV(string $nomorPs, string $ipTv): bool
    {
        try {
            $response = Http::timeout(10)->post("http://{$ipTv}:8001/api/v2/", [
                'method' => 'ms.remote.control',
                'params' => [
                    'Cmd' => 'Click',
                    'DataOfCmd' => 'KEY_POWER',
                    'Option' => 'false',
                    'TypeOfRemote' => 'SendRemoteKey'
                ]
            ]);

            if ($response->successful()) {
                Log::info("TV {$nomorPs} berhasil dimatikan via {$ipTv}");
                return true;
            } else {
                Log::error("Gagal mematikan TV {$nomorPs}: " . $response->body());
                return false;
            }

        } catch (\Exception $e) {
            Log::error("Error shutdown TV {$nomorPs}: " . $e->getMessage());
            return false;
        }
    }
}
