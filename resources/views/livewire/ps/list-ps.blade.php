
<div class="max-w-4xl mx-auto p-6 bg-white border border-gray-200 rounded-2xl shadow-md dark:bg-gray-800 dark:border-gray-700">
   <div class="fixed top-4 right-4 z-50 space-y-3">
  @if (session()->has('success'))
  <div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 3000)" 
      x-show="show" 
      x-transition.opacity.duration.500ms
      class="flex items-center max-w-sm p-4 text-green-700 bg-green-100 border border-green-300 rounded-lg shadow dark:bg-green-900 dark:text-green-200 dark:border-green-700"
      role="alert">

    <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L9 14.414 5.293 10.707a1 1 0 011.414-1.414L9 11.586l6.293-6.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
    </svg>
    
    <span class="text-sm font-medium">{{ session('success') }}</span>
  </div>
  @endif

  @if (session()->has('error'))
  <div 
      x-data="{ show: true }" 
      x-init="setTimeout(() => show = false, 3000)" 
      x-show="show" 
      x-transition.opacity.duration.500ms
      class="flex items-center max-w-sm p-4 text-red-700 bg-red-100 border border-red-300 rounded-lg shadow dark:bg-red-900 dark:text-red-200 dark:border-red-700"
      role="alert">

    <svg class="w-5 h-5 mr-2 shrink-0" fill="currentColor" viewBox="0 0 20 20">
      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-4h2v2H9v-2zm0-8h2v6H9V6z"/>
    </svg>
    
    <span class="text-sm font-medium">{{ session('error') }}</span>
  </div>
  @endif
</div>
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Kelola PS</h1>
    <a href="{{ route('ps.create') }}" 
       class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none" 
       wire:navigate>
      + Tambah PS
    </a>
  </div>
  <div class="mb-4">
    <input type="text" wire:model.live="search" 
      class="w-full p-2 border border-gray-300 rounded-lg dark:border-gray-600 dark:bg-gray-700 dark:text-white"
      placeholder="Cari ps...">
  </div>
  <div class="relative overflow-x-auto rounded-lg border border-gray-200 dark:border-gray-700">
    <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
      <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
        <tr>
          <th class="px-6 py-3">Nama PS</th>
          <th class="px-6 py-3">Nomer PS</th>
          <th class="px-6 py-3">IP TV</th>
          <th class="px-6 py-3 text-center">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($ps as $row)
        <tr class="bg-white border-b hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
          <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
            {{ $row->nama_ps }}
          </td>
          <td class="px-6 py-4">{{ $row->nomor_ps }}</td>
          <td class="px-6 py-4">{{ $row->ip_tv }}</td>
          <td class="px-6 py-4 text-center">
            <a href="/ps/{{ $row->id }}/edit" 
               class="text-blue-600 hover:underline dark:text-blue-400 mr-2" wire:navigate>
              Edit
            </a>
            <button wire:click="delete({{ $row->id }})" 
                    class="text-red-600 hover:underline dark:text-red-400">
              Hapus
            </button>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center py-4 text-gray-500 dark:text-gray-400">Tidak ada data ditemukan</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="mt-4">
    {{ $ps->links() }}
  </div>
</div>
