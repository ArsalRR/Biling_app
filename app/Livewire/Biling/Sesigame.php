<?php

namespace App\Livewire\Biling;

use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use App\Models\SesiGaming;
use App\Models\Paket;
use App\Models\PS;

class Sesigame extends Component
{
    use WithPagination;

    public $showModal = false;
    public $showExtendModal = false;
    public $editMode = false;
    public $sesiId;
    public $paket_id = '';
    public $ps_id = '';
    public $waktu_mulai;
    public $catatan = '';

    // Untuk perpanjangan waktu
    public $extendSesiId;
    public $extendPaketId = '';
    public $tambahanWaktu = 0;

    public $filterStatus = '';
    public $filterTanggal = '';
    public $search = '';
    
    protected $rules = [
        'paket_id' => 'required|integer|exists:paket,id',
        'ps_id' => 'required|integer|exists:ps,id',
        'waktu_mulai' => 'required|date',
        'catatan' => 'nullable|string|max:255'
    ];

    protected $extendRules = [
        'extendPaketId' => 'required|integer|exists:paket,id'
    ];

    protected $messages = [
        'paket_id.required' => 'Paket harus dipilih',
        'paket_id.exists' => 'Paket tidak valid',
        'ps_id.required' => 'PS harus dipilih',
        'ps_id.exists' => 'PS tidak valid',
        'waktu_mulai.required' => 'Waktu mulai harus diisi',
        'extendPaketId.required' => 'Paket perpanjangan harus dipilih',
        'extendPaketId.exists' => 'Paket tidak valid',
    ];

    public function mount()
    {
        $this->waktu_mulai = now()->format('Y-m-d\TH:i');
        $this->filterTanggal = today()->format('Y-m-d');
    }

    public function render()
    {
        $query = SesiGaming::with('paket', 'ps')
            // Hanya tampilkan sesi yang belum selesai
            ->where('status', '!=', 'selesai')
            ->when($this->search, function($q) {
                $q->whereHas('ps', function($ps) {
                    $ps->where('nama_ps', 'like', '%' . $this->search . '%')
                      ->orWhere('nomor_ps', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->filterStatus, function($q) {
                $q->where('status', $this->filterStatus);
            })
            ->when($this->filterTanggal, function($q) {
                $q->whereDate('waktu_mulai', $this->filterTanggal);
            })
            ->orderBy('waktu_mulai', 'desc');

        $sesiGaming = $query->paginate(10);
        $pakets = Paket::all();
        $activePsIds = SesiGaming::aktif()->pluck('ps_id')->toArray();
        $ps = PS::whereNotIn('id', $activePsIds)->get();
        SesiGaming::autoCompleteExpiredSessions();
        
        return view('livewire.biling.sesigame', [
            'sesiGaming' => $sesiGaming,
            'pakets' => $pakets,
            'ps' => $ps,
            'totalAktif' => SesiGaming::aktif()->count(),
            'totalHariIni' => SesiGaming::hariIni()->count(),
            'pendapatanHariIni' => SesiGaming::hariIni()->selesai()->sum('total_harga')
        ]);
    }

    public function openModal($sesiId = null)
    {
        $this->resetValidation();
        
        if ($sesiId) {
            $this->editMode = true;
            $this->sesiId = $sesiId;
            $sesi = SesiGaming::find($sesiId);
            if ($sesi) {
                $this->paket_id = $sesi->paket_id;
                $this->ps_id = $sesi->ps_id;
                $this->waktu_mulai = $sesi->waktu_mulai->format('Y-m-d\TH:i');
                $this->catatan = $sesi->catatan ?? '';
            }
        } else {
            $this->editMode = false;
            $this->resetForm();
        }
        
        $this->showModal = true;
    }

    public function openExtendModal($sesiId)
    {
        $this->resetValidation();
        $this->extendSesiId = $sesiId;
        $this->extendPaketId = '';
        $this->tambahanWaktu = 0;
        $this->showExtendModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function closeExtendModal()
    {
        $this->showExtendModal = false;
        $this->extendSesiId = null;
        $this->extendPaketId = '';
        $this->tambahanWaktu = 0;
        $this->resetValidation();
    }

    public function save()
    {
        if (empty($this->ps_id)) {
            $this->ps_id = null;
        }
        if (empty($this->paket_id)) {
            $this->paket_id = null;
        }

        $this->validate();
        
        $waktuMulai = Carbon::parse($this->waktu_mulai);
        
        $paket = Paket::find($this->paket_id);
        if (!$paket) {
            $this->addError('paket_id', 'Paket tidak ditemukan');
            return;
        }
        
        $ps = PS::find($this->ps_id);
        if (!$ps) {
            $this->addError('ps_id', 'PS tidak ditemukan');
            return;
        }
        $waktuSelesai = $waktuMulai->copy()->addMinutes($paket->durasi_menit);
        $totalHarga = $paket->harga;

        $data = [
            'paket_id' => (int)$this->paket_id,
            'ps_id' => (int)$this->ps_id,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'total_harga' => $totalHarga,
            'catatan' => $this->catatan,
            'status' => 'aktif',
            'tv_dimatikan' => false
        ];

        try {
            if ($this->editMode) {
                $sesi = SesiGaming::find($this->sesiId);
                if ($sesi) {
                    $sesi->update($data);
                    $this->dispatch('alert', [
                        'type' => 'success', 
                        'message' => 'Sesi gaming berhasil diupdate'
                    ]);
                }
            } else {
                $existingSession = SesiGaming::where('ps_id', $this->ps_id)
                    ->where('status', 'aktif')
                    ->exists();
                    
                if ($existingSession) {
                    $this->addError('ps_id', 'PS sudah digunakan untuk sesi aktif lainnya');
                    return;
                }

                SesiGaming::create($data);
                $this->dispatch('alert', [
                    'type' => 'success', 
                    'message' => 'Sesi gaming berhasil ditambahkan'
                ]);
            }

            $this->closeModal();
            
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error', 
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function extendTime()
    {
        $this->validate($this->extendRules, [
            'extendPaketId.required' => 'Paket perpanjangan harus dipilih'
        ]);

        $sesi = SesiGaming::find($this->extendSesiId);
        
        if (!$sesi || $sesi->status !== 'aktif') {
            $this->dispatch('alert', [
                'type' => 'error', 
                'message' => 'Sesi tidak ditemukan atau sudah tidak aktif'
            ]);
            return;
        }

        $paket = Paket::find($this->extendPaketId);
        if (!$paket) {
            $this->addError('extendPaketId', 'Paket tidak ditemukan');
            return;
        }

        try {
            // Tambah waktu selesai dan harga
            $waktuSelesaiBaru = Carbon::parse($sesi->waktu_selesai)->addMinutes($paket->durasi_menit);
            $totalHargaBaru = $sesi->total_harga + $paket->harga;

            $sesi->update([
                'waktu_selesai' => $waktuSelesaiBaru,
                'total_harga' => $totalHargaBaru,
                'catatan' => $sesi->catatan . ' | Diperpanjang: +' . $paket->durasi_menit . ' menit'
            ]);

            $this->dispatch('alert', [
                'type' => 'success', 
                'message' => 'Waktu sesi berhasil diperpanjang ' . $paket->durasi_menit . ' menit'
            ]);

            $this->closeExtendModal();
            
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error', 
                'message' => 'Gagal memperpanjang waktu: ' . $e->getMessage()
            ]);
        }
    }

    public function selesaikanSesi($sesiId)
    {
        $sesi = SesiGaming::find($sesiId);
        
        if ($sesi && $sesi->status === 'aktif') {
            $sesi->update([
                'status' => 'selesai',
                'waktu_selesai' => now(),
                'tv_dimatikan' => true
            ]);
            
            $this->dispatch('alert', [
                'type' => 'success', 
                'message' => 'Sesi berhasil diselesaikan'
            ]);
        }
    }

    public function batalkanSesi($sesiId)
    {
        $sesi = SesiGaming::find($sesiId);
        
        if ($sesi && $sesi->status === 'aktif') {
            $sesi->update(['status' => 'batal']);
            $this->dispatch('alert', [
                'type' => 'warning', 
                'message' => 'Sesi berhasil dibatalkan'
            ]);
        }
    }

    public function hapusSesi($sesiId)
    {
        try {
            SesiGaming::destroy($sesiId);
            $this->dispatch('alert', [
                'type' => 'success', 
                'message' => 'Sesi berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            $this->dispatch('alert', [
                'type' => 'error', 
                'message' => 'Gagal menghapus sesi'
            ]);
        }
    }

    public function resetForm()
    {
        $this->paket_id = '';
        $this->ps_id = '';
        $this->waktu_mulai = now()->format('Y-m-d\TH:i');
        $this->catatan = '';
        $this->sesiId = null;
    }

    public function updatedPaketId()
    {
        if ($this->paket_id) {
            $paket = Paket::find($this->paket_id);
            if ($paket) {
                $this->dispatch('paketSelected', [
                    'harga' => $paket->harga,
                    'durasi' => $paket->durasi_menit
                ]);
            }
        }
    }

    public function updatedExtendPaketId()
    {
        if ($this->extendPaketId) {
            $paket = Paket::find($this->extendPaketId);
            if ($paket) {
                $this->tambahanWaktu = $paket->durasi_menit;
            }
        }
    }

    public function getSelectedPaketInfo()
    {
        if ($this->paket_id) {
            $paket = Paket::find($this->paket_id);
            if ($paket) {
                return [
                    'nama' => $paket->nama_paket,
                    'harga' => $paket->harga,
                    'durasi' => $paket->durasi_menit
                ];
            }
        }
        return null;
    }

    public function getSelectedExtendPaketInfo()
    {
        if ($this->extendPaketId) {
            $paket = Paket::find($this->extendPaketId);
            if ($paket) {
                return [
                    'nama' => $paket->nama_paket,
                    'harga' => $paket->harga,
                    'durasi' => $paket->durasi_menit
                ];
            }
        }
        return null;
    }

    public function getAvailablePS()
    {
        $activePsIds = SesiGaming::aktif()->pluck('ps_id')->toArray();
        return PS::whereNotIn('id', $activePsIds)->get();
    }

    // Method untuk cek apakah sesi masih berjalan
    public function isSesiRunning($sesi)
    {
        return $sesi->status === 'aktif' && now()->lt($sesi->waktu_selesai);
    }

    // Method untuk mendapatkan sisa waktu
    public function getSisaWaktu($sesi)
    {
        if ($sesi->status !== 'aktif') {
            return 0;
        }
        
        $sekarang = now();
        $waktuSelesai = Carbon::parse($sesi->waktu_selesai);
        
        if ($sekarang->gte($waktuSelesai)) {
            return 0;
        }
        
        return $sekarang->diffInMinutes($waktuSelesai);
    }
}