<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DistribusiPerlengkapanController;
use App\Http\Controllers\InventarisPerlengkapanController;
use App\Http\Controllers\JadwalKeberangkatanController;
use App\Http\Controllers\PaketUmrahController;
use App\Http\Controllers\JamaahController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\TentangKamiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanPimpinanController;
use App\Models\PaketUmrah;
use App\Models\Galeri;
use App\Models\Artikel;

// Route::get('/', function () {
//     return view('dashboard.index');
// })->name('dashboard.index');

// Route::get('/', function () {
//     return view('pengguna.home');
// })->name('home');

Route::get('/', function () {
    $paketUmrahs = PaketUmrah::latest()->take(3)->get();
    $galeris = Galeri::latest()->paginate(6);
    $artikels = Artikel::latest()->get(); 
    return view('pengguna.home', compact('paketUmrahs', 'galeris', 'artikels'));
})->name('home'); 

// Route registrasi
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

// Route login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'role:Admin,Direktur Keuangan,Pimpinan'])->group(function () {
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

    // Jamaah
    Route::get('jamaah/cetak_pdf', [JamaahController::class, 'cetakPDF'])->name('jamaah.cetak_pdf');
    Route::resource('jamaah', JamaahController::class);

    // Pemesanan
    // Route::get('pemesanan/cetak_pdf', [PemesananController::class, 'cetakPDF'])->name('pemesanan.cetak_pdf');
    // Route::resource('pemesanan', PemesananController::class);

    // Inventaris Perlengkapan
    Route::get('inventaris/cetak_pdf', [InventarisPerlengkapanController::class, 'cetakPDF'])->name('inventaris.cetak_pdf');
    Route::resource('inventaris', InventarisPerlengkapanController::class);

    // Distribusi Perlengkapan
    Route::get('distribusi/cetak_pdf', [DistribusiPerlengkapanController::class, 'cetakPDF'])->name('distribusi.cetak_pdf');
    Route::resource('distribusi', DistribusiPerlengkapanController::class);

    // User
    Route::get('user/cetak_pdf', [UserController::class, 'cetakPDF'])->name('user.cetak_pdf');
    Route::resource('user', UserController::class);

    // Pembayaran
    // Route::get('pembayaran/cetak_pdf', [PembayaranController::class, 'cetakPDF'])->name('pembayaran.cetak_pdf');
    // Route::resource('pembayaran', PembayaranController::class);

    // Route::patch('/pembayaran/{id}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
});


Route::middleware(['auth', 'role:Admin,Direktur Keuangan'])->prefix('manajemen')->name('dashboard.')->group(function () {
    Route::get('pemesanan/cetak_pdf', [PemesananController::class, 'cetakPDF'])->name('pemesanan.cetak_pdf');
    Route::resource('pemesanan', PemesananController::class);

    // Pembayaran
    Route::get('pembayaran/cetak_pdf', [PembayaranController::class, 'cetakPDF'])->name('pembayaran.cetak_pdf');
    Route::resource('pembayaran', PembayaranController::class);
    Route::patch('/pembayaran/{id}/status', [PembayaranController::class, 'updateStatus'])->name('pembayaran.updateStatus');
});

Route::get('/artikel', [ArtikelController::class, 'artikel'])->name('pengguna.artikel');
Route::get('/artikel/{id}', [ArtikelController::class, 'detailArtikel'])->name('pengguna.detail_artikel');

Route::get('/galeri', [GaleriController::class, 'tampilPenggunaGaleri'])->name('pengguna.galeri');

Route::get('/paket-umrah', [PaketUmrahController::class, 'listPaket'])->name('pengguna.paket');
Route::get('/paket-umrah/{id}', [PaketUmrahController::class, 'showPaket'])->name('pengguna.detail_paket')->middleware(['auth', 'role:Jamaah']);


Route::get('/form-jamaah', [JamaahController::class, 'create'])->name('pengguna.formjamaah')->middleware(['auth', 'role:Jamaah']);
Route::post('/jamaah', [JamaahController::class, 'store'])->name('jamaah.store')->middleware(['auth', 'role:Jamaah']);
Route::post('/pemesanan', [PemesananController::class, 'store'])->name('pemesanan.store')->middleware(['auth', 'role:Jamaah']);

Route::get('/reservasi/{id}', function ($id) {
    $pemesanan = \App\Models\Pemesanan::with([
        'jamaah',
        'jadwalKeberangkatan.paket',
        'pembayarans'
    ])->findOrFail($id);

    return view('pengguna.riwayat_reservasi', compact('pemesanan'));
})->name('pengguna.riwayat_reservasi')->middleware(['auth', 'role:Jamaah']);

Route::resource('pembayaran', PembayaranController::class);

Route::get('/invoice/{id}', [PembayaranController::class, 'cetakInvoice'])->name('pembayaran.invoice')->middleware(['auth', 'role:Jamaah']);

Route::get('/riwayat-reservasi', [PembayaranController::class, 'riwayat'])->name('riwayat.reservasi')->middleware(['auth', 'role:Jamaah']);

Route::get('/tentangkami', [TentangKamiController::class, 'index'])->name('tentangkami');

Route::get('/riwayat-perlengkapan', [DistribusiPerlengkapanController::class, 'riwayatPerlengkapan'])->name('riwayat.perlengkapan')->middleware(['auth', 'role:Jamaah']);

// Halaman utama laporan
Route::get('/laporan', function () {
    return view('dashboard.laporan.index');
})->name('laporan.index')->middleware(['auth', 'role:Pimpinan']);

// Laporan PDF
Route::get('/laporan/pembayaran', [LaporanPimpinanController::class, 'cetakPembayaran'])->name('laporan.cetakPembayaran')->middleware(['auth', 'role:Pimpinan']);
Route::get('/laporan/pemesanan', [LaporanPimpinanController::class, 'cetakPemesanan'])->name('laporan.cetakPemesanan')->middleware(['auth', 'role:Pimpinan']);
Route::get('/laporan/jamaah', [LaporanPimpinanController::class, 'cetakJamaah'])->name('laporan.cetakJamaah')->middleware(['auth', 'role:Pimpinan']);
Route::get('/laporan/inventaris', [LaporanPimpinanController::class, 'cetakInventaris'])->name('laporan.cetakInventaris')->middleware(['auth', 'role:Pimpinan']);
Route::get('/laporan/paket', [LaporanPimpinanController::class, 'cetakPaket'])->name('laporan.cetakPaket')->middleware(['auth', 'role:Pimpinan']);
Route::get('/laporan/distribusi', [LaporanPimpinanController::class, 'cetakDistribusi'])->name('laporan.cetakDistribusi')->middleware(['auth', 'role:Pimpinan']);
Route::get('/laporan/jadwal', [LaporanPimpinanController::class, 'cetakJadwal'])->name('laporan.cetakJadwal')->middleware(['auth', 'role:Pimpinan']);

Route::middleware(['auth', 'role:Jamaah'])->group(function () {
    Route::get('/dokumen-saya', [JamaahController::class, 'dokumenSaya'])->name('jamaah.dokumenSaya');
    Route::get('/dokumen-saya/edit', [JamaahController::class, 'editDokumenSaya'])->name('jamaah.editDokumenSaya');
    Route::put('/dokumen-saya/update', [JamaahController::class, 'updateDokumenSaya'])->name('jamaah.updateDokumenSaya');
});
