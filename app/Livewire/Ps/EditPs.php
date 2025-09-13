<?php

namespace App\Livewire\Ps;

use App\Models\PS;
use Livewire\Component;

class EditPs extends Component
{
     public $psId;
    public $nama_ps, $nomor_ps, $ip_tv;

    public function mount(int $id)
    {
        $this->psId = $id;

        $ps = PS::find($id);

        if (!$ps) {
            session()->flash('error', 'Playstation tidak ditemukan.');
            return redirect()->route('ps');
        }

        $this->nama_ps         = $ps->nama_ps;
        $this->nomor_ps        = $ps->nomor_ps;
        $this->ip_tv    = $ps->ip_tv;
    }

    public function update()
    {
        $this->validate([
            'nama_ps'         => 'required|string|max:255',
            'nomor_ps'        => 'required|string|max:255',
            'ip_tv'    => 'required|string|max:255',
    
        ]);

        $ps = PS::find($this->psId);

        if (!$ps) {
            session()->flash('error', 'Playstation tidak ditemukan.');
            return redirect()->route('ps');
        }

        $ps->update([
            'nama_ps'         => $this->nama_ps,
            'nomor_ps'        => $this->nomor_ps,
            'ip_tv'    => $this->ip_tv,
        ]);

        session()->flash('success', 'Playstation berhasil diperbarui.');
        return redirect()->route('ps');
    }

    public function render()
    {
        return view('livewire.ps.edit-ps');
    }
}
