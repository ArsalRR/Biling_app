<div>
  <div
    class="max-w-2xl mx-auto p-6 bg-white border border-gray-200 rounded-2xl shadow-md dark:bg-gray-800 dark:border-gray-700">
    <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">Edit Kelola Playstation</h1>

    <form class="space-y-5" wire:submit.prevent="update">
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Playstation</label>
        <input type="text" id="name" wire:model="nama_ps"
          class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
        @error('nama_ps')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>
      <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nomer PS</label>
        <textarea id="description" rows="3" wire:model="nomor_ps"
          class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
        @error('nomor_ps')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>
        <div>
        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">IP Televisi</label>
        <textarea id="description" rows="3" wire:model="ip_tv"
          class="mt-1 block w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
        @error('ip_tv')
        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
        @enderror
      </div>
     
      <!-- Tombol -->
      <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('ps') }}" wire:navigate
          class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-lg shadow hover:bg-gray-700 focus:ring-2 focus:ring-gray-400 focus:outline-none">
          Batal
        </a>
        <button type="submit"
          class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400 focus:outline-none">
          Update Kelola Playstation
        </button>
      </div>
    </form>
  </div>
</div>
