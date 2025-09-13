<?php

namespace App\Livewire\Ps;

use App\Models\PS;
use Livewire\Component;

class CreatePs extends Component
{
public $nama_ps;
    public $nomor_ps;
    public $ip_tv;
 
    public function submit (){
        $this->validate([
            'nama_ps' => 'required',
            'nomor_ps' => 'required',
            'nomor_ps' => 'unique:ps,nomor_ps',
            'ip_tv' => 'required',
            'ip_tv' => 'unique:ps,ip_tv',
        ],[
            'nama_ps.required' => 'Nama PS harus diisi.',
            'nomor_ps.required' => 'Nomer PS harus diisi.',
            'nomor_ps.unique' => 'Nomer PS sudah terdaftar.',
            'ip_tv.required' => 'IP TV harus diisi.',
            'ip_tv.unique' => 'IP TV sudah terdaftar.',
        ]);

        PS::create([
            'nama_ps' => $this->nama_ps,
            'nomor_ps' => $this->nomor_ps,
            'ip_tv' => $this->ip_tv,
        ]);

        $this->reset();
        session()->flash('message', 'PS created successfully.');
        $this->redirect('/ps');
    }

    public function render()
    {

        return view('livewire.ps.create-ps');
    }
}
