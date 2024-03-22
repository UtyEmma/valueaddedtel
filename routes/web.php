<?php

use App\Enums\Services;
use App\Http\Controllers\ProfileController;
use App\Livewire\Pages\Services\AirtimeTopup;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/wire/set', $handle);
});

Route::view('/', 'welcome');

Route::middleware(['auth', 'verified', 'user.pin'])->group(function(){
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Route::prefix('profile')->group(function(){
        Route::get('', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('wallet', [ProfileController::class, 'wallet'])->name('profile.wallet');
        Route::get('referrals', [ProfileController::class, 'referrals'])->name('profile.referrals');
        Route::get('edit', [ProfileController::class, 'edit'])->name('profile.edit');
    });

    Route::middleware('service.module:'.Services::AIRTIME->value)->group(function(){
        Route::get('airtime', AirtimeTopup::class)->name('services.airtime');
    });
});


require __DIR__.'/auth.php';
