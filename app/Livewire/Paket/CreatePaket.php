<?php

namespace App\Livewire\Paket;

use App\Models\Paket;
use Livewire\Component;

class CreatePaket extends Component
{
    public $nama, $harga, $deskripsi, $durasi_menit;

    public function submit()
    {
        $this->validate([
            'nama' => 'required',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'durasi_menit' => 'required|numeric',
        ],[
            'nama.required' => 'Nama paket harus diisi',
            'harga.required' => 'Harga paket harus diisi',
            'harga.numeric' => 'Harga paket harus berupa angka',
            'deskripsi.required' => 'Deskripsi paket harus diisi',
            'durasi_menit.required' => 'Durasi paket harus diisi',
            'durasi_menit.numeric' => 'Durasi paket harus berupa angka',
        ]);

        Paket::create([
            'nama' => $this->nama,
            'harga' => preg_replace('/[^0-9]/', '', $this->harga),
            'deskripsi' => $this->deskripsi,
            'durasi_menit' => $this->durasi_menit,
        ]);

        $this->reset();

        session()->flash('success', 'Paket berhasil dibuat.');
        return redirect()->route('paket');
    }

    public function render()
    {

        return view('livewire.paket.create-paket');
    }
}
