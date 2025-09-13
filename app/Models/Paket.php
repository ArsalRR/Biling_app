<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paket extends Model
{
    protected $table = 'paket';
    
    protected $fillable = [
        'nama',
        'durasi_menit',
        'harga',
        'deskripsi',
        'aktif'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'aktif' => 'boolean',
        'durasi_menit' => 'integer'
    ];
    public function sesiGaming(): HasMany
    {
        return $this->hasMany(SesiGaming::class, 'paket_id');
    }
    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }
    public function getDurasiFormatted(): string
    {
        $jam = floor($this->durasi_menit / 60);
        $menit = $this->durasi_menit % 60;
        
        if ($jam > 0 && $menit > 0) {
            return $jam . ' jam ' . $menit . ' menit';
        } elseif ($jam > 0) {
            return $jam . ' jam';
        } else {
            return $menit . ' menit';
        }
    }
    public function getHargaFormatted(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
    public function getPendapatanHariIni(): float
    {
        return $this->sesiGaming()
            ->where('status', 'selesai')
            ->whereDate('waktu_mulai', today())
            ->sum('total_harga');
    }
    public function getJumlahSesiHariIni(): int
    {
        return $this->sesiGaming()
            ->where('status', 'selesai')
            ->whereDate('waktu_mulai', today())
            ->count();
    }
}