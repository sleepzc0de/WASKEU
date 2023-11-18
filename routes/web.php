<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\wasdal\pemantauan\form\FormPSPController;
use App\Http\Controllers\wasdal\pemantauan\PemantauanPeriodikController;
use App\Http\Controllers\wasdal\pemantauan\periodik\PemantauanPemanfaatanPeriodikController;
use App\Http\Controllers\wasdal\pemantauan\periodik\PemantauanPenggunaanPeriodikController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('layouts.wasdal.master');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


 Route::get('/pemantauan-periodik-pemanfaatan', [PemantauanPemanfaatanPeriodikController::class, 'index'])->name('pemantauan-pemanfaatan-periodik.index');

 Route::get('/pemantauan-periodik-penggunaan', [PemantauanPenggunaanPeriodikController::class, 'index'])->name('pemantauan-penggunaan-periodik.index');

 Route::prefix('pemantauan-periodik-penggunaan')->group(function () {
     Route::resource('form-psp', FormPSPController::class);
     Route::post('kode-barang/{id}', [FormPSPController::class, 'getKodeBarang'])->name('getKodeBarang');
     Route::post('nup-barang/{id1}/{id2}', [FormPSPController::class, 'getNupBarang'])->name('getNupBarang');
     Route::post('nilai-buku/{id1}/{id2}/{id3}', [FormPSPController::class, 'getNilaiBukuBarang'])->name('getNilaiBukuBarang');

});

require __DIR__.'/auth.php';
