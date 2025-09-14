<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-gray-900 dark:to-gray-800 p-4 sm:p-6 lg:p-8">
  <div class="fixed top-4 right-4 z-50 space-y-3">
    @if (session()->has('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show" 
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="flex items-center max-w-sm p-4 text-emerald-800 bg-emerald-50 border-l-4 border-emerald-400 rounded-r-xl shadow-lg backdrop-blur-sm dark:bg-emerald-900/20 dark:text-emerald-200 dark:border-emerald-500"
        role="alert">

      <div class="flex-shrink-0">
        <svg class="w-6 h-6 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
        </svg>
      </div>
      
      <div class="ml-3">
        <p class="text-sm font-medium">{{ session('success') }}</p>
      </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show" 
        x-transition:enter="transform ease-out duration-300 transition"
        x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
        x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="flex items-center max-w-sm p-4 text-red-800 bg-red-50 border-l-4 border-red-400 rounded-r-xl shadow-lg backdrop-blur-sm dark:bg-red-900/20 dark:text-red-200 dark:border-red-500"
        role="alert">

      <div class="flex-shrink-0">
        <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
        </svg>
      </div>
      
      <div class="ml-3">
        <p class="text-sm font-medium">{{ session('error') }}</p>
      </div>
    </div>
    @endif
  </div>

  <div class="max-w-7xl mx-auto">
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 sm:p-8 mb-6">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <h1 class="text-3xl font-bold text-gray-900 dark:text-white bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
            Daftar Paket
          </h1>
          <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola semua paket layanan Anda</p>
        </div>
        
        <a href="{{ route('paket.create') }}" 
           class="inline-flex items-center px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" 
           wire:navigate>
          <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
          </svg>
          Tambah Paket Baru
        </a>
      </div>
    </div>
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 p-6 mb-6">
      <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
          <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
          </svg>
        </div>
        <input type="text" wire:model.live="search" 
          class="w-full pl-12 pr-4 py-4 text-gray-900 placeholder-gray-500 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white transition-all duration-200"
          placeholder="Cari nama paket, tipe, atau deskripsi...">
      </div>
    </div>
    <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 dark:border-gray-700/50 overflow-hidden">
      <div class="block sm:hidden">
        @forelse ($paket as $row)
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
          <div class="flex items-start justify-between mb-3">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $row->nama }}</h3>
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $row->aktif ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300' }}">
              {{ $row->aktif ? 'Aktif' : 'Nonaktif' }}
            </span>
          </div>
          
          <div class="grid grid-cols-2 gap-4 text-sm mb-4">
            <div>
              <span class="text-gray-500 dark:text-gray-400">Tipe:</span>
              <p class="font-medium text-gray-900 dark:text-white">{{ $row->tipe }}</p>
            </div>
            <div>
              <span class="text-gray-500 dark:text-gray-400">Durasi:</span>
              <p class="font-medium text-gray-900 dark:text-white">{{ $row->durasi_menit }} menit</p>
            </div>
            <div>
              <span class="text-gray-500 dark:text-gray-400">Harga per Jam:</span>
              <p class="font-medium text-blue-600 dark:text-blue-400">Rp {{ number_format($row->harga_per_jam, 0, ',', '.') }}</p>
            </div>
            <div>
              <span class="text-gray-500 dark:text-gray-400">Total Harga:</span>
              <p class="font-semibold text-green-600 dark:text-green-400">Rp {{ number_format($row->harga, 0, ',', '.') }}</p>
            </div>
          </div>
          
          @if($row->deskripsi)
          <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">{{ $row->deskripsi }}</p>
          @endif
          
          <div class="flex space-x-3">
            <a href="/paket/{{ $row->id }}/edit" 
               class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-700 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors duration-200 dark:text-blue-400 dark:bg-blue-900/20 dark:hover:bg-blue-900/30" 
               wire:navigate>
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
              </svg>
              Edit
            </a>
            <button wire:click="delete({{ $row->id }})" 
                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-700 bg-red-50 hover:bg-red-100 rounded-lg transition-colors duration-200 dark:text-red-400 dark:bg-red-900/20 dark:hover:bg-red-900/30">
              <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 012 0v6a1 1 0 11-2 0V9zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V9z" clip-rule="evenodd"/>
              </svg>
              Hapus
            </button>
          </div>
        </div>
        @empty
        <div class="text-center py-12">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m-4 4v4m0-4h4"/>
          </svg>
          <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">Tidak ada paket</h3>
          <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Mulai dengan membuat paket pertama Anda.</p>
        </div>
        @endforelse
      </div>

      <!-- Desktop Table View -->
      <div class="hidden sm:block overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <thead class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800">
            <tr>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Nama Paket</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Tipe</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Harga/Jam</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Durasi</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Total Harga</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Deskripsi</th>
              <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Status</th>
              <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider dark:text-gray-300">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
            @forelse ($paket as $row)
            <tr class="hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 dark:hover:from-gray-700/50 dark:hover:to-gray-600/50 transition-all duration-200">
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-semibold text-gray-900 dark:text-white">{{ $row->nama }}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300">
                  {{ $row->tipe }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-blue-600 dark:text-blue-400">
                Rp {{ number_format($row->harga_per_jam, 0, ',', '.') }}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                {{ $row->durasi_menit }} menit
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-green-600 dark:text-green-400">
                Rp {{ number_format($row->harga, 0, ',', '.') }}
              </td>
              <td class="px-6 py-4">
                <div class="max-w-xs">
                  <p class="text-sm text-gray-600 dark:text-gray-400 truncate" title="{{ $row->deskripsi }}">
                    {{ $row->deskripsi }}
                  </p>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium {{ $row->aktif ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/20 dark:text-emerald-300' : 'bg-red-100 text-red-800 dark:bg-red-900/20 dark:text-red-300' }}">
                  <span class="w-2 h-2 mr-2 rounded-full {{ $row->aktif ? 'bg-emerald-400' : 'bg-red-400' }}"></span>
                  {{ $row->aktif ? 'Aktif' : 'Nonaktif' }}
                </span>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="flex items-center justify-center space-x-2">
                  <a href="/paket/{{ $row->id }}/edit" 
                     class="inline-flex items-center p-2 text-sm font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-lg transition-all duration-200 dark:text-blue-400 dark:hover:bg-blue-900/20" 
                     wire:navigate
                     title="Edit paket">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                    </svg>
                  </a>
                  <button wire:click="delete({{ $row->id }})" 
                          class="inline-flex items-center p-2 text-sm font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition-all duration-200 dark:text-red-400 dark:hover:bg-red-900/20"
                          title="Hapus paket">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9zM4 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 012 0v6a1 1 0 11-2 0V9zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V9z" clip-rule="evenodd"/>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="8" class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2M4 13h2m0 0V9a2 2 0 012-2h2m-4 4v4m0-4h4"/>
                </svg>
                <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum ada paket</h3>
                <p class="text-gray-500 dark:text-gray-400">Silakan tambah paket pertama Anda untuk memulai.</p>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
    @if($paket->hasPages())
    <div class="mt-6 flex justify-center">
      <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 dark:border-gray-700/50 p-2">
        {{ $paket->links() }}
      </div>
    </div>
    @endif
  </div>
</div>