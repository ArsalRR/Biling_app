<?php

namespace App\Livewire\Ps;

use App\Models\PS;
use Livewire\Component;
use Livewire\WithPagination;

class ListPs extends Component
{
     use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';

    protected $listeners = ['deleteConfirmed' => 'delete'];

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
      

        $ps = PS::where('nama_ps', 'like', '%' . $this->search . '%')
            ->orWhere('nomor_ps', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.ps.list-ps', [
            'ps' => $ps,
        ]);
        
    }
    public function delete($id)
    {
        $ps = PS::find($id);

        if ($ps) {
            $ps->delete();
            session()->flash('success', 'PS berhasil dihapus.');
            return redirect()->route('ps');
        
        }
    }
}
