<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\JadwalKeberangkatanController;
use App\Http\Controllers\PaketUmrahController;

// Route::get('/', function () {
//     return view('dashboard.index');
// })->name('dashboard.index');

Route::get('/', function () {
    return view('pengguna.home');
})->name('home');

// Route registrasi
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Route login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route dashboard untuk role admin, super admin, kurir
Route::middleware(['auth', 'role:Admin, Direktur Keuangan, Pimpinan'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard.index');
});

Route::middleware(['auth', 'role:Admin'])->prefix('admin')->name('dashboard.')->group(function () {
    // Galeri
    Route::get('galeri/cetak_pdf', [GaleriController::class, 'cetakPDF'])->name('galeri.cetak_pdf');
    Route::resource('galeri', GaleriController::class);

    // Artikel
    Route::get('artikel/cetak_pdf', [ArtikelController::class, 'cetakPDF'])->name('artikel.cetak_pdf');
    Route::resource('artikel', ArtikelController::class);

    // Paket Umrah
    Route::get('paketumrah/cetak_pdf', [PaketUmrahController::class, 'cetakPDF'])->name('paket.cetak_pdf');
    Route::resource('paket', PaketUmrahController::class);

    // Jadwal Keberangkatan
    Route::get('jadwal/cetak_pdf', [JadwalKeberangkatanController::class, 'cetakPDF'])->name('jadwal.cetak_pdf');
    Route::resource('jadwal', JadwalKeberangkatanController::class);
});

Route::get('/artikel', [ArtikelController::class, 'artikel'])->name('pengguna.artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'detailArtikel'])->name('pengguna.detail_artikel');

Route::get('/galeri', [GaleriController::class, 'tampilPenggunaGaleri'])->name('pengguna.galeri');



