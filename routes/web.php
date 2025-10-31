<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileController;

// Controller Umum
use App\Http\Controllers\Site\SiteController;
// Controller Admin
use App\Http\Controllers\Admin\{
    JenisHewanController,
    RasHewanController,
    KategoriController,
    KategoriKlinisController,
    KodeTindakanController,
    PetController,
    PemilikController
};

// ========================================
// 🌐 Halaman Publik
// ========================================
Route::get('/', [SiteController::class, 'homeindex'])->name('home');
Route::get('/layanan', [SiteController::class, 'layananindex'])->name('layanan');
Route::get('/kontak', [SiteController::class, 'kontakindex'])->name('kontak');

// ========================================
// 🔍 Cek Koneksi Database
// ========================================
Route::get('/cek-koneksi', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        return "✅ Koneksi ke database <strong>{$dbName}</strong> berhasil!";
    } catch (\Exception $e) {
        return "❌ Koneksi gagal: " . $e->getMessage();
    }
});

// ========================================
// 🔐 Area Login (Breeze yang handle)
// ========================================
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ========================================
// 🔒 Area yang Butuh Login
// ========================================
Route::middleware('auth')->group(function () {
    // 🧩 Dashboard per role
    Route::get('administrator/dashboard', fn() => view('admin.dashboard', ['user' => Auth::user()]))->name('administrator.dashboard');
    Route::get('dokter/dashboard', fn() => view('dokter.dashboard', ['user' => Auth::user()]))->name('dokter.dashboard');
    Route::get('perawat/dashboard', fn() => view('perawat.dashboard', ['user' => Auth::user()]))->name('perawat.dashboard');
    Route::get('resepsionis/dashboard', fn() => view('resepsionis.dashboard', ['user' => Auth::user()]))->name('resepsionis.dashboard');
    Route::get('pemilik/dashboard', fn() => view('pemilik.dashboard', ['user' => Auth::user()]))->name('pemilik.dashboard');

    // 🧩 Data Master (Admin)
    Route::prefix('administrator')->name('admin.')->group(function () {
        Route::view('/data-master', 'admin.data_master')->name('data.master');
        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis.index');
        Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras.index');
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategoriKlinis.index');
        Route::get('/kode-tindakan', [KodeTindakanController::class, 'index'])->name('kode.index');
        Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
        Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    });

    // 🧍 Profile (Breeze bawaan)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// include semua route auth (login/register/logout)
require __DIR__.'/auth.php';
