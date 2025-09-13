<?php

use App\Livewire\Biling\Sesigame as BilingSesigame;
use App\Livewire\Paket\CreatePaket;
use App\Livewire\Paket\EditPaket;
use App\Livewire\Paket\ListPaket;
use App\Livewire\Ps\CreatePs;
use App\Livewire\Ps\EditPs;
use App\Livewire\Ps\ListPs;

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::prefix('paket')->group(function () {
        Route::get('/', ListPaket::class)->name('paket');
        Route::get('create', CreatePaket::class)->name('paket.create');
        Route::get('{id}/edit', EditPaket::class)->name('paket.edit');
    });
    Route::prefix('ps')->group(function () {
        Route::get('/', ListPs::class)->name('ps');
        Route::get('create', CreatePs::class)->name('ps.create');
        Route::get('{id}/edit', EditPs::class)->name('ps.edit');
    });
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('sesi', BilingSesigame::class)->name('sesi');
});

require __DIR__.'/auth.php';
