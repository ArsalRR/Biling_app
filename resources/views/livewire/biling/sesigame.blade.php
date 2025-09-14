<div>
  <div class="w-full p-4 space-y-6" wire:poll.30s>
  <div class="fixed top-4 right-4 z-50 space-y-3">
    @if (session()->has('success'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show" 
        x-transition:enter="transform ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform ease-in duration-200"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="flex items-center max-w-sm p-4 text-green-800 bg-green-50 border-l-4 border-green-400 rounded-r-lg shadow-lg backdrop-blur-sm"
        role="alert">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
      </div>
    </div>
    @endif

    @if (session()->has('error'))
    <div 
        x-data="{ show: true }" 
        x-init="setTimeout(() => show = false, 4000)" 
        x-show="show" 
        x-transition:enter="transform ease-out duration-300"
        x-transition:enter-start="translate-x-full opacity-0"
        x-transition:enter-end="translate-x-0 opacity-100"
        x-transition:leave="transform ease-in duration-200"
        x-transition:leave-start="translate-x-0 opacity-100"
        x-transition:leave-end="translate-x-full opacity-0"
        class="flex items-center max-w-sm p-4 text-red-800 bg-red-50 border-l-4 border-red-400 rounded-r-lg shadow-lg backdrop-blur-sm"
        role="alert">
      <div class="flex items-center">
        <div class="flex-shrink-0">
          <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
          </svg>
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
      </div>
    </div>
    @endif
  </div>
  <div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard PS Rental</h1>
    <p class="text-gray-600">Kelola sesi gaming dan pantau pendapatan secara real-time</p>
  </div>
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="relative overflow-hidden bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
      <div class="p-6">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-blue-100 text-sm font-medium mb-1">Sesi Aktif</p>
            <h3 class="text-3xl font-bold mb-2">{{ $totalAktif }}</h3>
            <div class="flex items-center text-xs text-blue-100">
              <div class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></div>
              Sedang berlangsung
            </div>
          </div>
          <div class="bg-white/20 p-3 rounded-xl">
            <i class="fas fa-gamepad text-2xl"></i>
          </div>
        </div>
      </div>
      <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mt-10"></div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-cyan-500 to-cyan-600 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
      <div class="p-6">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-cyan-100 text-sm font-medium mb-1">Sesi Hari Ini</p>
            <h3 class="text-3xl font-bold mb-2">{{ $totalHariIni }}</h3>
            <div class="flex items-center text-xs text-cyan-100">
              <i class="fas fa-arrow-up mr-1"></i>
              Total sesi
            </div>
          </div>
          <div class="bg-white/20 p-3 rounded-xl">
            <i class="fas fa-calendar-day text-2xl"></i>
          </div>
        </div>
      </div>
      <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mt-10"></div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
      <div class="p-6">
        <div class="flex justify-between items-start">
          <div>
            <p class="text-emerald-100 text-sm font-medium mb-1">Pendapatan Hari Ini</p>
            <h3 class="text-2xl font-bold mb-2">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
            <div class="flex items-center text-xs text-emerald-100">
              <i class="fas fa-coins mr-1"></i>
              Earning today
            </div>
          </div>
          <div class="bg-white/20 p-3 rounded-xl">
            <i class="fas fa-money-bill-wave text-2xl"></i>
          </div>
        </div>
      </div>
      <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mt-10"></div>
    </div>

    <div class="relative overflow-hidden bg-gradient-to-br from-amber-400 to-amber-500 text-gray-800 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
      <div class="p-6">
        <div class="flex justify-between items-start">
         <div>
  <p class="text-amber-800 text-sm font-medium mb-1">PS Tersedia</p>
  <h3 class="text-3xl font-bold mb-2">{{ $totalPS - $totalAktif }}</h3>
  <div class="flex items-center text-xs text-amber-800">
    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
    Siap digunakan
  </div>
</div>

          <div class="bg-white/20 p-3 rounded-xl">
            <i class="fas fa-tv text-2xl"></i>
          </div>
        </div>
      </div>
      <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mt-10"></div>
    </div>
  </div>
  <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
      <div>
        <h2 class="text-xl font-semibold text-gray-900 mb-1">Manajemen Billing Game</h2>
        <p class="text-gray-500 text-sm">Kelola sesi gaming dan transaksi</p>
      </div>
      <button wire:click="openModal" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-medium rounded-xl shadow-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 transform hover:scale-105 hover:shadow-xl">
        <i class="fas fa-plus mr-2"></i>
        Tambah Sesi Baru
      </button>
    </div>
  </div>
  <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
    @forelse($sesiGaming as $sesi)
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
        <div class="p-6 pb-4">
          <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-3">
              <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                <i class="fas fa-gamepad text-lg"></i>
              </div>
              <div>
                <div class="font-semibold text-gray-900 text-lg">{{ $sesi->ps->nomor_ps }}</div>
                @if($sesi->ps->ip_tv)
                  <div class="text-xs text-gray-500 font-mono bg-gray-100 px-2 py-1 rounded-md inline-block">{{ $sesi->ps->ip_tv }}</div>
                @endif
              </div>
            </div>
            <span class="px-3 py-1 text-xs font-semibold rounded-full
              @if($sesi->status === 'aktif') bg-green-100 text-green-700 ring-2 ring-green-200
              @elseif($sesi->status === 'selesai') bg-gray-100 text-gray-700 ring-2 ring-gray-200
              @elseif($sesi->status === 'dibatalkan') bg-red-100 text-red-700 ring-2 ring-red-200
              @else bg-blue-100 text-blue-700 ring-2 ring-blue-200 @endif">
              {{ ucfirst($sesi->status) }}
            </span>
          </div>
        </div>
        <div wire:poll.60s="refreshSessions" class="px-6 pb-4">
          <div class="space-y-3 text-sm">
            <div class="bg-gray-50 p-3 rounded-lg">
              <div class="flex items-center justify-between">
                <span class="font-semibold text-gray-900">{{ $sesi->paket->nama ?? 'N/A' }}</span>
                @if($sesi->paket->tipe === 'durasi')
  <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium">
    {{ $sesi->paket->durasi_menit }} menit
  </span>
@endif

              </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
              <div>
                <span class="text-gray-500 text-xs font-medium block mb-1">Mulai</span>
                <div class="font-medium text-gray-900">{{ $sesi->waktu_mulai->format('d/m H:i') }}</div>
              </div>
            @if($sesi->paket->tipe !== 'los')
              <div>
                <span class="text-gray-500 text-xs font-medium block mb-1">Selesai</span>
                <div class="font-medium text-gray-900">{{ $sesi->waktu_selesai->format('d/m H:i') }}</div>
              </div>
            </div>
           <div>
            @endif
  <span class="text-gray-500 text-xs font-medium block mb-1">
    {{ $sesi->paket->tipe === 'los' ? 'Waktu Main' : 'Sisa Waktu' }}
  </span>

  @if($sesi->status === 'aktif')
    @php $sisaWaktu = $this->getSisaWaktu($sesi); @endphp

    @if($sesi->paket->tipe === 'los')
      <div class="text-blue-600 font-bold text-lg">
        {{ floor($sisaWaktu / 60) }}j {{ $sisaWaktu % 60 }}m
      </div>
    @else
      <div class="text-lg font-bold {{ $sisaWaktu <= 0 ? 'text-red-600' : ($sisaWaktu <= 15 ? 'text-amber-600' : 'text-green-600') }}">
        @if($sisaWaktu <= 0)
          <span class="animate-pulse flex items-center">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            Waktu Habis
          </span>
        @else
          {{ floor($sisaWaktu / 60) }}j {{ $sisaWaktu % 60 }}m
        @endif
      </div>
    @endif
  @else
    <div class="text-gray-400">-</div>
  @endif
</div>

            <div wire:poll.30s>
              <span class="text-gray-500 text-xs font-medium block mb-1">
                @if($sesi->paket->tipe === 'los')
                  Total Sementara
                @else
                  Total Harga
                @endif
              </span>
              <div class="text-lg font-bold text-green-600">
                @if($sesi->paket->tipe === 'los')
                  Rp {{ number_format($this->getRunningTotal($sesi), 0, ',', '.') }}
                @else
                  Rp {{ number_format($sesi->total_harga, 0, ',', '.') }}
                @endif
              </div>
            </div>
            @if($sesi->catatan)
            <div>
              <span class="text-gray-500 text-xs font-medium block mb-1">Catatan</span>
              <div class="text-xs bg-blue-50 border border-blue-200 p-3 rounded-lg text-gray-700">{{ $sesi->catatan }}</div>
            </div>
            @endif
          </div>
        </div>
        <div class="p-6 pt-0">
          <div class="flex gap-2 flex-wrap">
            @if($sesi->status === 'aktif')
            <button wire:click="openExtendModal({{ $sesi->id }})"
                    class="flex-1 bg-gradient-to-r from-purple-500 to-purple-600 text-white px-3 py-2 rounded-lg hover:from-purple-600 hover:to-purple-700 flex items-center justify-center gap-2 transition-all duration-200 font-medium text-sm shadow-md hover:shadow-lg">
              <i class="fas fa-clock"></i>
              <span>Tambah</span>
            </button>
            <button wire:click="selesaikanSesi({{ $sesi->id }})"
                    wire:confirm="Yakin ingin menyelesaikan sesi ini?"
                    class="flex-1 bg-gradient-to-r from-green-500 to-green-600 text-white px-3 py-2 rounded-lg hover:from-green-600 hover:to-green-700 flex items-center justify-center gap-2 transition-all duration-200 font-medium text-sm shadow-md hover:shadow-lg">
              <i class="fas fa-check"></i>
              <span>Selesai</span>
            </button>
            <button wire:click="batalkanSesi({{ $sesi->id }})"
                    wire:confirm="Yakin ingin membatalkan sesi ini?"
                    class="flex-1 bg-gradient-to-r from-amber-400 to-amber-500 text-white px-3 py-2 rounded-lg hover:from-amber-500 hover:to-amber-600 flex items-center justify-center gap-2 transition-all duration-200 font-medium text-sm shadow-md hover:shadow-lg">
              <i class="fas fa-times"></i>
              <span>Batal</span>
            </button>
            @endif
            <button wire:click="hapusSesi({{ $sesi->id }})"
                    wire:confirm="Yakin ingin menghapus sesi ini?"
                    class="flex-1 bg-gradient-to-r from-red-500 to-red-600 text-white px-3 py-2 rounded-lg hover:from-red-600 hover:to-red-700 flex items-center justify-center gap-2 transition-all duration-200 font-medium text-sm shadow-md hover:shadow-lg">
              <i class="fas fa-trash"></i>
              <span>Hapus</span>
            </button>
          </div>
        </div>
      </div>
    @empty
      <div class="col-span-full">
        <div class="text-center py-16 bg-white rounded-2xl border-2 border-dashed border-gray-200">
          <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fas fa-inbox text-2xl text-gray-400"></i>
          </div>
          <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada sesi gaming</h3>
          <p class="text-gray-500 mb-6">Mulai dengan membuat sesi gaming baru</p>
          <button wire:click="openModal" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Tambah Sesi Pertama
          </button>
        </div>
      </div>
    @endforelse
  </div>
  <div class="mt-8 flex justify-center">
    {{ $sesiGaming->links() }}
  </div>
  @if($showModal)
  <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" 
       wire:click.self="closeModal">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
      <form wire:submit.prevent="save">
        <div class="p-6 border-b border-gray-200">
          <div class="flex justify-between items-center">
            <div>
              <h3 class="text-xl font-semibold text-gray-900">{{ $editMode ? 'Edit Sesi' : 'Tambah Sesi Baru' }}</h3>
              <p class="text-sm text-gray-500 mt-1">{{ $editMode ? 'Perbarui informasi sesi gaming' : 'Buat sesi gaming baru untuk customer' }}</p>
            </div>
            <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg transition-colors">
              <i class="fas fa-times text-lg"></i>
            </button>
          </div>
        </div>
        <div class="p-6 space-y-6">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
           <div x-data="{ open: false, search: '' }" class="relative">
  <label class="block text-sm font-medium text-gray-900 mb-2">
    Paket PlayStation <span class="text-red-500">*</span>
  </label>
  <button type="button" @click="open = !open"
    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-left flex justify-between items-center">
    <span>
      @if($paket_id)
        {{ $pakets->find($paket_id)->nama }} - Rp {{ number_format($pakets->find($paket_id)->harga, 0, ',', '.') }} ({{ $pakets->find($paket_id)->durasi_menit }}m)
      @else
        Pilih Paket Gaming
      @endif
    </span>
    <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M6 8l4 4 4-4" />
    </svg>
  </button>
  <div x-show="open" @click.outside="open = false"
    class="absolute z-10 mt-2 w-full bg-white rounded-lg shadow-lg">
    <div class="p-2">
      <input type="text" x-model="search" placeholder="Cari paket..."
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
    </div>
    <ul class="max-h-60 overflow-y-auto text-sm text-gray-700">
  @foreach($pakets->where('aktif', 1) as $paket)
    <li>
      <button type="button"
        @click="$wire.paket_id = {{ $paket->id }}; open = false"
        x-show="'{{ strtolower($paket->nama) }}'.includes(search.toLowerCase())"
        class="w-full text-left px-4 py-2 hover:bg-gray-100">
        
        {{ $paket->nama }} 
        @if($paket->tipe === 'durasi')
          - Rp {{ number_format($paket->harga, 0, ',', '.') }} ({{ $paket->durasi_menit }}m)
        @else
          - Rp {{ number_format($paket->harga_per_jam, 0, ',', '.') }}/jam
        @endif
      </button>
    </li>
  @endforeach
</ul>

  </div>

  @error('paket_id')
    <p class="text-red-500 text-sm mt-2 flex items-center">
      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
    </p>
  @enderror
</div>
            <div>
              <label class="block text-sm font-medium text-gray-900 mb-2">
                PlayStation Station <span class="text-red-500">*</span>
              </label>
              <select wire:model="ps_id" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors bg-white">
                <option value="">Pilih PS Station</option>
                @foreach($ps as $p)
                  <option value="{{ $p->id }}">{{ $p->nomor_ps }} - {{ $p->nama_ps }}</option>
                @endforeach
              </select>
              @error('ps_id') <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-900 mb-2">
              Waktu Mulai <span class="text-red-500">*</span>
            </label>
            <input type="datetime-local" wire:model="waktu_mulai" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
            @error('waktu_mulai') <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
          </div>
          
          <!-- Notes -->
          <div>
            <label class="block text-sm font-medium text-gray-900 mb-2">Catatan</label>
            <textarea wire:model="catatan" rows="4" placeholder="Tambahkan catatan khusus untuk sesi ini..."
                      class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors resize-none"></textarea>
            @error('catatan') <p class="text-red-500 text-sm mt-2 flex items-center"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p> @enderror
          </div>
        </div>
        
        <!-- Modal Footer -->
        <div class="flex justify-end gap-3 border-t border-gray-200 px-6 py-4 bg-gray-50 rounded-b-2xl">
          <button type="button" wire:click="closeModal" class="px-6 py-3 rounded-xl bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors font-medium">
            Batal
          </button>
          <button type="submit" 
                  class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 text-white hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl disabled:opacity-50 flex items-center"
                  wire:loading.attr="disabled"
                  wire:target="save">
            <span wire:loading.remove wire:target="save">
              <i class="fas fa-{{ $editMode ? 'edit' : 'plus' }} mr-2"></i>
              {{ $editMode ? 'Update Sesi' : 'Buat Sesi' }}
            </span>
            <span wire:loading wire:target="save" class="flex items-center">
              <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
  @endif

  <!-- Extend Time Modal -->
  @if($showExtendModal)
  <div class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" 
       wire:click.self="closeExtendModal">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
      <!-- Modal Header -->
      <div class="p-6 border-b border-gray-200">
        <div class="flex justify-between items-center">
          <div>
            <h3 class="text-xl font-semibold text-gray-900">Perpanjang Waktu Sesi</h3>
            <p class="text-sm text-gray-500 mt-1">Tambahkan waktu bermain untuk sesi yang sedang aktif</p>
          </div>
          <button wire:click="closeExtendModal" class="text-gray-400 hover:text-gray-600 p-2 hover:bg-gray-100 rounded-lg transition-colors">
            <i class="fas fa-times text-lg"></i>
          </button>
        </div>
      </div>
      
      <div class="p-6">
        <form wire:submit.prevent="extendTime">
          <div class="space-y-6">
            <!-- Current Session Info -->
            @if($extendSesiId)
              @php
                $currentSesi = $sesiGaming->where('id', $extendSesiId)->first();
              @endphp
              @if($currentSesi)
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-4 rounded-xl border">
                  <h4 class="font-semibold text-sm mb-3 text-gray-900 flex items-center">
                    <i class="fas fa-info-circle mr-2 text-blue-500"></i>
                    Informasi Sesi Saat Ini
                  </h4>
                  <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="space-y-2">
                      <div class="flex justify-between">
                        <span class="text-gray-600">PlayStation:</span>
                        <span class="font-medium text-gray-900">{{ $currentSesi->ps->nomor_ps }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-600">Paket:</span>
                        <span class="font-medium text-gray-900">{{ $currentSesi->paket->nama }}</span>
                      </div>
                    </div>
                    <div class="space-y-2">
                      <div class="flex justify-between">
                        <span class="text-gray-600">Selesai:</span>
                        <span class="font-medium text-gray-900">{{ $currentSesi->waktu_selesai->format('d/m H:i') }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-gray-600">Total Saat Ini:</span>
                        <span class="font-medium text-green-600">Rp {{ number_format($currentSesi->total_harga, 0, ',', '.') }}</span>
                      </div>
                    </div>
                  </div>

                  <!-- Remaining Time Display -->
                  <div class="mt-3 pt-3 border-t border-gray-200">
                    @if($currentSesi->paket->tipe === 'los')
                      <div class="flex justify-between items-center">
                        <span class="text-gray-600 text-sm">Durasi:</span>
                        @php $durasi = $this->getSisaWaktu($currentSesi); @endphp
                        <span class="text-blue-600 font-bold">
                          {{ floor($durasi / 60) }}j {{ $durasi % 60 }}m
                        </span>
                      </div>
                    @else
                      <div class="flex justify-between items-center">
                        <span class="text-gray-600 text-sm">Sisa Waktu:</span>
                        @php $sisaWaktu = $this->getSisaWaktu($currentSesi); @endphp
                        <span class="font-bold {{ $sisaWaktu <= 0 ? 'text-red-600' : ($sisaWaktu <= 15 ? 'text-amber-600' : 'text-green-600') }}" wire:poll.30s>
                          @if($sisaWaktu <= 0)
                            <span class="animate-pulse flex items-center">
                              <i class="fas fa-exclamation-triangle mr-1"></i>
                              Waktu Habis
                            </span>
                          @else
                            {{ floor($sisaWaktu / 60) }}j {{ $sisaWaktu % 60 }}m
                          @endif
                        </span>
                      </div>
                    @endif
                  </div>
                </div>
              @endif
            @endif
            @if($extendSesiId)
              @php
                $sesi = \App\Models\SesiGaming::find($extendSesiId);
              @endphp

              @if($sesi && $sesi->paket->tipe === 'durasi')
               <div x-data="{
    open: false,
    search: '',
    selectedText: 'Pilih paket untuk perpanjangan...',
    selectPaket(id, text) {
        this.selectedText = text
        this.open = false
        $wire.extendPaketId = id
    }
}">
  <label class="block text-sm font-medium text-gray-900 mb-3">
    Pilih Paket Perpanjangan <span class="text-red-500">*</span>
  </label>

  <!-- Trigger -->
  <button @click="open = !open"
    type="button"
    class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-white text-left flex justify-between items-center">
    <span x-text="selectedText"></span>
    <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 20 20">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M6 8l4 4 4-4" />
    </svg>
  </button>

  <!-- Dropdown -->
  <div x-show="open" @click.outside="open = false"
    class="z-10 mt-2 bg-white rounded-lg shadow w-full">
    <div class="p-3">
      <input type="text" x-model="search" placeholder="Cari paket..."
        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500">
    </div>
    <ul class="max-h-60 overflow-y-auto text-sm text-gray-700">
      @foreach($pakets as $paket)
        @if($paket->tipe === 'durasi')
          <li>
            <button type="button"
              @click="selectPaket({{ $paket->id }}, '{{ $paket->nama }} - {{ $paket->durasi_menit }} menit - Rp {{ number_format($paket->harga, 0, ',', '.') }}')"
              x-show="'{{ strtolower($paket->nama) }}'.includes(search.toLowerCase()) ||
                      '{{ strtolower($paket->durasi_menit) }}'.includes(search.toLowerCase()) ||
                      '{{ strtolower(number_format($paket->harga, 0, ',', '.')) }}'.includes(search.toLowerCase())"
              class="w-full text-left px-4 py-2 hover:bg-gray-100">
              {{ $paket->nama }} - {{ $paket->durasi_menit }} menit - Rp {{ number_format($paket->harga, 0, ',', '.') }}
            </button>
          </li>
        @endif
      @endforeach
    </ul>
  </div>

  @error('extendPaketId') 
    <p class="text-red-500 text-sm mt-2 flex items-center">
      <i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}
    </p> 
  @enderror
</div>

              @endif
            @endif
            @if($extendPaketId && $currentSesi)
              @php
                $selectedPaket = $pakets->where('id', $extendPaketId)->first();
              @endphp
              @if($selectedPaket)
                <div class="bg-gradient-to-r from-purple-50 to-blue-50 p-4 rounded-xl border border-purple-200">
                  <h4 class="font-semibold text-sm mb-3 text-purple-900 flex items-center">
                    <i class="fas fa-preview mr-2"></i>
                    Preview Perpanjangan
                  </h4>
                  <div class="grid grid-cols-2 gap-4 text-sm">
                    <div class="space-y-2">
                      <div class="flex justify-between">
                        <span class="text-purple-700">Tambahan Waktu:</span>
                        <span class="font-semibold text-purple-900">{{ $selectedPaket->durasi_menit }} menit</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-purple-700">Tambahan Biaya:</span>
                        <span class="font-semibold text-purple-900">Rp {{ number_format($selectedPaket->harga, 0, ',', '.') }}</span>
                      </div>
                    </div>
                    <div class="space-y-2">
                      <div class="flex justify-between">
                        <span class="text-purple-700">Selesai Baru:</span>
                        <span class="font-semibold text-purple-900">{{ \Carbon\Carbon::parse($currentSesi->waktu_selesai)->addMinutes($selectedPaket->durasi_menit)->format('d/m H:i') }}</span>
                      </div>
                      <div class="flex justify-between">
                        <span class="text-purple-700">Total Baru:</span>
                        <span class="font-semibold text-green-600">Rp {{ number_format($currentSesi->total_harga + $selectedPaket->harga, 0, ',', '.') }}</span>
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            @endif
          </div>

          <!-- Modal Footer -->
          <div class="flex justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
            <button type="button" wire:click="closeExtendModal" 
                    class="px-6 py-3 rounded-xl bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 transition-colors font-medium">
              Batal
            </button>
            <button type="submit"
                    class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-purple-700 text-white hover:from-purple-700 hover:to-purple-800 disabled:opacity-50 flex items-center transition-all duration-200 font-medium shadow-lg hover:shadow-xl"
                    wire:loading.attr="disabled"
                    wire:target="extendTime"
                    {{ !$extendPaketId ? 'disabled' : '' }}>
              <span wire:loading.remove wire:target="extendTime" class="flex items-center">
                <i class="fas fa-clock mr-2"></i>
                Perpanjang Waktu
              </span>
              <span wire:loading wire:target="extendTime" class="flex items-center">
                <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
              </span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endif
</div>
</div>