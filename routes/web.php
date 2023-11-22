<?php

use App\Http\Controllers\helper\HelperWasdalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\wasdal\pemantauan\form\FormKesesuaianPSPController;
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


 Route::resource('pemantauan-periodik-pemanfaatan', PemantauanPemanfaatanPeriodikController::class);

 Route::prefix('pemantauan-penggunaan')->middleware('auth')->group(function () {
     Route::resource('periodik-penggunaan', PemantauanPenggunaanPeriodikController::class);
     Route::resource('form-psp', FormPSPController::class);
     Route::resource('form-kesesuaian-psp', FormKesesuaianPSPController::class);

     // REFERENSI

Route::prefix('wasdal-referensi')->group(function () {
Route::post('kode-barang-all', [HelperWasdalController::class, 'getKodeBarangAll'])->name('getKodeBarangAll');
});
 Route::post('kode-barang/{id}', [HelperWasdalController::class, 'getKodeBarang'])->name('getKodeBarang');
     Route::post('nup-barang/{id1}/{id2}', [HelperWasdalController::class, 'getNupBarang'])->name('getNupBarang');
     Route::post('nilai-buku/{id1}/{id2}/{id3}', [HelperWasdalController::class, 'getNilaiBukuBarang'])->name('getNilaiBukuBarang');
    Route::post('generate-data-pemantauan-penggunaan', [HelperWasdalController::class, 'GenerateDataPemantauanPenggunaan'])->name('getDataPemantauanPenggunaan');
});



require __DIR__.'/auth.php';
