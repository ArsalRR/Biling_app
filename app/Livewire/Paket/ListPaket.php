<?php

namespace App\Livewire\Paket;

use App\Models\Paket;
use Livewire\Component;
use Livewire\WithPagination;

class ListPaket extends Component
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
        $paket = Paket::where('nama', 'like', '%' . $this->search . '%')
            ->orWhere('deskripsi', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(5);

        return view('livewire.paket.list-paket', [
            'paket' => $paket,
        ]);
    }
    public function delete($id)
    {
        $paket = Paket::find($id);

        if ($paket) {
            $paket->delete();
            session()->flash('success', 'Paket berhasil dihapus.');
            return redirect()->route('paket');
        
        }
    }
}
