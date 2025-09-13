<div class="w-full p-4 space-y-6" wire:poll.30s>
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

  <!-- Cards Statistik -->
  <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    <div class="bg-blue-500 text-white rounded-2xl shadow p-4 flex justify-between items-center">
      <div>
        <p class="text-sm">Sesi Aktif</p>
        <h3 class="text-2xl font-bold">{{ $totalAktif }}</h3>
      </div>
      <i class="fas fa-gamepad text-3xl"></i>
    </div>
    <div class="bg-sky-500 text-white rounded-2xl shadow p-4 flex justify-between items-center">
      <div>
        <p class="text-sm">Hari Ini</p>
        <h3 class="text-2xl font-bold">{{ $totalHariIni }}</h3>
      </div>
      <i class="fas fa-calendar-day text-3xl"></i>
    </div>
    <div class="bg-green-500 text-white rounded-2xl shadow p-4 flex justify-between items-center">
      <div>
        <p class="text-sm">Pendapatan Hari Ini</p>
        <h3 class="text-2xl font-bold">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h3>
      </div>
      <i class="fas fa-money-bill-wave text-3xl"></i>
    </div>
    <div class="bg-yellow-400 text-gray-800 rounded-2xl shadow p-4 flex justify-between items-center">
      <div>
        <p class="text-sm">PS Tersedia</p>
        <h3 class="text-2xl font-bold">{{ 10 - $totalAktif }}</h3>
      </div>
      <i class="fas fa-tv text-3xl"></i>
    </div>
  </div>

  <!-- Header dengan Tombol Tambah -->
  <div class="bg-white rounded-2xl shadow p-6">
    <div class="flex flex-col md:flex-row justify-between items-center mb-4">
      <h2 class="text-lg font-semibold">Manajemen Sesi Gaming</h2>
      <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded-xl shadow hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>Tambah Sesi Baru
      </button>
    </div>
  </div>

  <!-- Grid Sesi Gaming -->
  <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
    @forelse($sesiGaming as $sesi)
      <div class="bg-white rounded-2xl shadow p-5 flex flex-col justify-between hover:shadow-lg transition">
        <div class="flex items-center justify-between mb-4">
          <div class="flex items-center gap-2">
            <i class="fas fa-gamepad text-blue-500"></i>
            <div>
              <div class="font-semibold">{{ $sesi->ps->nomor_ps }}</div>
              @if($sesi->ps->ip_tv)
                <div class="text-xs text-gray-500">{{ $sesi->ps->ip_tv }}</div>
              @endif
            </div>
          </div>
          <span class="px-2 py-1 text-xs rounded-lg font-medium
            @if($sesi->status === 'aktif') bg-green-100 text-green-700
            @elseif($sesi->status === 'selesai') bg-gray-100 text-gray-700
            @elseif($sesi->status === 'dibatalkan') bg-red-100 text-red-700
            @else bg-blue-100 text-blue-700 @endif">
            {{ ucfirst($sesi->status) }}
          </span>
        </div>

        <div class="space-y-2 text-sm">
          <div>
            <span class="font-semibold">{{ $sesi->paket->nama ?? 'N/A' }}</span>
            <div class="text-xs text-gray-500">
              {{ $sesi->paket->durasi_menit ?? 0 }} menit
            </div>
          </div>
          <div>
            <span class="text-gray-500">Mulai:</span>
            <div class="font-medium">{{ $sesi->waktu_mulai->format('d/m/Y H:i') }}</div>
          </div>
          <div>
            <span class="text-gray-500">Selesai:</span>
            <div class="font-medium">{{ $sesi->waktu_selesai->format('d/m/Y H:i') }}</div>
          </div>
          <div>
            <span class="text-gray-500">Sisa Waktu:</span>
            @if($sesi->status === 'aktif')
              @php
                $sisaWaktu = $this->getSisaWaktu($sesi);
              @endphp
              <div class="{{ $sisaWaktu <= 0 ? 'text-red-600 font-bold' : ($sisaWaktu <= 15 ? 'text-yellow-600 font-bold' : 'text-green-600') }}">
                @if($sisaWaktu <= 0)
                  <span class="animate-pulse">⚠️ Waktu Habis</span>
                @else
                  {{ floor($sisaWaktu / 60) }}j {{ $sisaWaktu % 60 }}m
                @endif
              </div>
            @else
              <div class="text-gray-400">-</div>
            @endif
          </div>
          <div>
            <span class="text-gray-500">Total:</span>
            <div class="font-semibold">Rp {{ number_format($sesi->total_harga, 0, ',', '.') }}</div>
          </div>
          @if($sesi->catatan)
          <div>
            <span class="text-gray-500">Catatan:</span>
            <div class="text-xs bg-gray-50 p-2 rounded mt-1">{{ $sesi->catatan }}</div>
          </div>
          @endif
        </div>

        <div class="mt-4 flex gap-2 flex-wrap">
          @if($sesi->status === 'aktif')
            <button wire:click="openExtendModal({{ $sesi->id }})"
                    class="flex-1 min-w-20 bg-purple-500 text-white p-2 rounded-lg hover:bg-purple-600 flex items-center justify-center gap-1 transition">
              <i class="fas fa-clock"></i>
              <span class="text-xs">Tambah</span>
            </button>
            
            <button wire:click="selesaikanSesi({{ $sesi->id }})"
                    wire:confirm="Yakin ingin menyelesaikan sesi ini?"
                    class="flex-1 min-w-20 bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 flex items-center justify-center gap-1 transition">
              <i class="fas fa-check"></i>
              <span class="text-xs">Selesai</span>
            </button>
            
            <button wire:click="batalkanSesi({{ $sesi->id }})"
                    wire:confirm="Yakin ingin membatalkan sesi ini?"
                    class="flex-1 min-w-20 bg-yellow-400 text-white p-2 rounded-lg hover:bg-yellow-500 flex items-center justify-center gap-1 transition">
              <i class="fas fa-times"></i>
              <span class="text-xs">Batal</span>
            </button>
          @endif
          
          <button wire:click="hapusSesi({{ $sesi->id }})"
                  wire:confirm="Yakin ingin menghapus sesi ini?"
                  class="flex-1 min-w-20 bg-red-500 text-white p-2 rounded-lg hover:bg-red-600 flex items-center justify-center gap-1 transition">
            <i class="fas fa-trash"></i>
            <span class="text-xs">Hapus</span>
          </button>
        </div>
      </div>
    @empty
      <div class="col-span-full text-center py-10 text-gray-400">
        <i class="fas fa-inbox text-3xl mb-2"></i>
        <p>Tidak ada data sesi gaming</p>
      </div>
    @endforelse
  </div>

  <div class="mt-6 flex justify-center">
    {{ $sesiGaming->links() }}
  </div>
  @if($showModal)
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
       wire:click.self="closeModal">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-3xl max-h-[90vh] overflow-y-auto">
      <form wire:submit.prevent="save">
        <div class="p-6 space-y-4">
          <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">{{ $editMode ? 'Edit Sesi' : 'Tambah Sesi Baru' }}</h3>
            <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 text-xl">
              <i class="fas fa-times"></i>
            </button>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium mb-1">Paket Playstation <span class="text-red-500">*</span></label>
              <select wire:model="paket_id" class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Pilih Paket</option>
                @foreach($pakets as $paket)
                  <option value="{{ $paket->id }}">{{ $paket->nama }} - Rp {{ number_format($paket->harga, 0, ',', '.') }} ({{ $paket->durasi_menit }}m)</option>
                @endforeach
              </select>
              @error('paket_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
              <label class="block text-sm font-medium mb-1">Tempat Playstation <span class="text-red-500">*</span></label>
              <select wire:model="ps_id" class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">Pilih Tempat</option>
                @foreach($ps as $p)
                  <option value="{{ $p->id }}">{{ $p->nomor_ps }} - {{ $p->nama_ps }}</option>
                @endforeach
              </select>
              @error('ps_id') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Waktu Mulai <span class="text-red-500">*</span></label>
            <input type="datetime-local" wire:model="waktu_mulai" class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            @error('waktu_mulai') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>
          
          <div>
            <label class="block text-sm font-medium mb-1">Catatan</label>
            <textarea wire:model="catatan" rows="3" placeholder="Catatan tambahan..."
                      class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
            @error('catatan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
          </div>
        </div>
        
        <div class="flex justify-end gap-2 border-t px-6 py-4">
          <button type="button" wire:click="closeModal" class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
            Batal
          </button>
          <button type="submit" 
                  class="px-4 py-2 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition disabled:opacity-50"
                  wire:loading.attr="disabled"
                  wire:target="save">
            <span wire:loading.remove wire:target="save">
              {{ $editMode ? 'Update Sesi' : 'Tambah Sesi' }}
            </span>
            <span wire:loading wire:target="save">
              <i class="fas fa-spinner fa-spin mr-2"></i>Memproses...
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
  @endif

  <!-- Modal Perpanjang Waktu -->
  @if($showExtendModal)
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" 
       wire:click.self="closeExtendModal">
    <div class="bg-white rounded-2xl shadow-lg w-full max-w-lg max-h-[90vh] overflow-y-auto">
      <div class="p-6">
        <div class="flex justify-between items-center mb-4">
          <h3 class="text-lg font-semibold">Perpanjang Waktu Sesi</h3>
          <button wire:click="closeExtendModal" class="text-gray-400 hover:text-gray-600 text-xl">
            <i class="fas fa-times"></i>
          </button>
        </div>
        
        <form wire:submit.prevent="extendTime">
          <div class="space-y-4">
            @if($extendSesiId)
              @php
                $currentSesi = $sesiGaming->where('id', $extendSesiId)->first();
              @endphp
              @if($currentSesi)
                <div class="bg-gray-50 p-4 rounded-lg border">
                  <h4 class="font-semibold text-sm mb-2 text-gray-700">Informasi Sesi Saat Ini</h4>
                  <div class="text-sm space-y-1">
                    <div class="flex justify-between">
                      <span class="text-gray-600">PS:</span>
                      <span class="font-medium">{{ $currentSesi->ps->nomor_ps }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Paket:</span>
                      <span class="font-medium">{{ $currentSesi->paket->nama }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Waktu Selesai Saat Ini:</span>
                      <span class="font-medium">{{ $currentSesi->waktu_selesai->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Total Harga Saat Ini:</span>
                      <span class="font-medium">Rp {{ number_format($currentSesi->total_harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-gray-600">Sisa Waktu:</span>
                      @php $sisaWaktu = $this->getSisaWaktu($currentSesi); @endphp
                      <span class="font-medium {{ $sisaWaktu <= 0 ? 'text-red-600' : ($sisaWaktu <= 15 ? 'text-yellow-600' : 'text-green-600') }}">
                        @if($sisaWaktu <= 0)
                          Waktu Habis
                        @else
                          {{ floor($sisaWaktu / 60) }}j {{ $sisaWaktu % 60 }}m
                        @endif
                      </span>
                    </div>
                  </div>
                </div>
              @endif
            @endif

            <div>
              <label class="block text-sm font-medium mb-2">Pilih Paket Perpanjangan <span class="text-red-500">*</span></label>
              <select wire:model.live="extendPaketId" class="w-full border rounded-xl px-3 py-2 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                <option value="">Pilih Paket</option>
                @foreach($pakets as $paket)
                  <option value="{{ $paket->id }}">
                    {{ $paket->nama }} - {{ $paket->durasi_menit }} menit - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                  </option>
                @endforeach
              </select>
              @error('extendPaketId') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            @if($extendPaketId && $currentSesi)
              @php
                $selectedPaket = $pakets->where('id', $extendPaketId)->first();
              @endphp
              @if($selectedPaket)
                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                  <h4 class="font-semibold text-sm mb-2 text-blue-800">Preview Perpanjangan</h4>
                  <div class="text-sm space-y-1">
                    <div class="flex justify-between">
                      <span class="text-blue-600">Tambahan Waktu:</span>
                      <span class="font-medium">{{ $selectedPaket->durasi_menit }} menit</span>
                    </div>
                    <div class="flex justify-between">
                      <span class="text-blue-600">Tambahan Biaya:</span>
                      <span class="font-medium">Rp {{ number_format($selectedPaket->harga, 0, ',', '.') }}</span>
                    </div>
                    <hr class="my-2 border-blue-200">
                    <div class="flex justify-between font-semibold">
                      <span class="text-blue-800">Waktu Selesai Baru:</span>
                      <span>{{ \Carbon\Carbon::parse($currentSesi->waktu_selesai)->addMinutes($selectedPaket->durasi_menit)->format('d/m/Y H:i') }}</span>
                    </div>
                    <div class="flex justify-between font-semibold">
                      <span class="text-blue-800">Total Harga Baru:</span>
                      <span>Rp {{ number_format($currentSesi->total_harga + $selectedPaket->harga, 0, ',', '.') }}</span>
                    </div>
                  </div>
                </div>
              @endif
            @endif
          </div>

          <div class="flex justify-end gap-2 mt-6">
            <button type="button" wire:click="closeExtendModal" 
                    class="px-4 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 transition">
              Batal
            </button>
            <button type="submit"
                    class="px-4 py-2 rounded-xl bg-purple-600 text-white hover:bg-purple-700 disabled:opacity-50 flex items-center transition"
                    wire:loading.attr="disabled"
                    wire:target="extendTime"
                    {{ !$extendPaketId ? 'disabled' : '' }}>
              <i class="fas fa-clock mr-2"></i>
              <span wire:loading.remove wire:target="extendTime">Perpanjang Waktu</span>
              <span wire:loading wire:target="extendTime">
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
