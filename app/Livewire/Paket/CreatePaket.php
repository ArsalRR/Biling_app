<?php

namespace App\Livewire\Paket;

use App\Models\Paket;
use Livewire\Component;

class CreatePaket extends Component
{
    public $nama, $harga, $deskripsi, $durasi_menit, $tipe = '', $aktif = 1, $harga_per_jam;

    public function submit()
    {
        
        $rules = [
            'nama' => 'required',
            'tipe' => 'required|in:durasi,los',
        ];

        if ($this->tipe === 'durasi') {
            $rules['harga'] = 'required';
            $rules['durasi_menit'] = 'required|numeric|min:1';
        }

        if ($this->tipe === 'los') {
            $rules['harga_per_jam'] = 'required|numeric|min:1000';
        }

        $this->validate($rules, [
            'nama.required' => 'Nama paket harus diisi',
            'tipe.required' => 'Tipe paket harus diisi',
            'harga.required' => 'Harga paket harus diisi',
            'harga_per_jam.required' => 'Harga per jam harus diisi',
            'durasi_menit.required' => 'Durasi paket harus diisi',
        ]);

        Paket::create([
            'nama' => $this->nama,
            'harga' => $this->tipe === 'durasi' ? preg_replace('/[^0-9]/', '', $this->harga) : null,
            'deskripsi' => $this->deskripsi,
            'durasi_menit' => $this->tipe === 'durasi' ? $this->durasi_menit : null,
            'tipe' => $this->tipe,
            'aktif' => $this->aktif,
            'harga_per_jam' => $this->tipe === 'los' ? preg_replace('/[^0-9]/', '', $this->harga_per_jam) : null,
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
