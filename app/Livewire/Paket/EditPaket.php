<?php

namespace App\Livewire\Paket;

use App\Models\Paket;
use Livewire\Component;

class EditPaket extends Component
{
    public $paketId;
    public $nama, $harga, $deskripsi, $durasi_menit, $aktif;

    public function mount(int $id)
    {
        $this->paketId = $id;

        $paket = Paket::find($id);

        if (!$paket) {
            session()->flash('error', 'Paket tidak ditemukan.');
            return redirect()->route('paket');
        }

        $this->nama         = $paket->nama;
        $this->harga        = $paket->harga;
        $this->deskripsi    = $paket->deskripsi;
        $this->durasi_menit = $paket->durasi_menit;
        $this->aktif        = $paket->aktif;
    }

    public function update()
    {
        $this->validate([
            'nama'         => 'required|string|max:255',
            'aktif'        => 'required|boolean',
        ]);

        $paket = Paket::find($this->paketId);

        if (!$paket) {
            session()->flash('error', 'Paket tidak ditemukan.');
            return redirect()->route('paket');
        }

        $paket->update([
            'nama'         => $this->nama,
            'harga'        => $this->harga,
            'deskripsi'    => $this->deskripsi,
            'durasi_menit' => $this->durasi_menit,
            'aktif'        => $this->aktif,
        ]);

        session()->flash('success', 'Paket berhasil diperbarui.');
        return redirect()->route('paket');
    }

    public function render()
    {
        return view('livewire.paket.edit-paket');
    }
}
