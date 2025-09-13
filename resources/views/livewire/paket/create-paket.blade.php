<div>
    <div class="max-w-2xl mx-auto p-6 bg-white border border-gray-200 rounded-2xl shadow-md dark:bg-gray-800 dark:border-gray-700">
  <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Tambah Paket</h1>

  <form class="space-y-5" wire:submit.prevent="submit">
    <div>
      <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Paket</label>
      <input type="text" id="name" wire:model="nama" 
        class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
      @error('nama') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>
    <div>
      <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Deskripsi</label>
      <textarea id="description" rows="3" wire:model="deskripsi" 
        class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
      @error('deskripsi') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Harga -->
    <div>
      <label for="price" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Harga</label>
      <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 dark:text-gray-400">
          Rp
        </span>
        <input type="text" id="price" wire:model="harga" 
          x-data
          x-on:input="$event.target.value = $event.target.value.replace(/[^0-9]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
          class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 pl-9 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
      </div>
      @error('harga') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Durasi -->
    <div>
      <label for="duration" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Durasi (menit)</label>
      <input type="number" id="duration" wire:model="durasi_menit"
        class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
      @error('durasi_menit') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
    </div>

    <!-- Aktif -->
    <div class="flex items-center space-x-2">
      <div class="flex items-center">
        <input type="radio" id="aktif" name="status" wire:model="aktif" value="1"
          class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" />
        <label for="aktif" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Aktif</label>
      </div>
      <div class="flex items-center ml-4">
        <input type="radio" id="nonaktif" name="status" wire:model="aktif" value="0"
          class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700" />
        <label for="nonaktif" class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">Nonaktif</label>
      </div>
    </div>
    <div class="flex justify-end gap-3 pt-4">
      <a href="{{ route('paket') }}" wire:navigate
        class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow hover:bg-gray-700 focus:ring-2 focus:ring-gray-400 focus:outline-none">
        Kembali
      </a>
      <button type="submit"
        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none">
        Simpan Paket
      </button>
    </div>
  </form>
</div>

</div>