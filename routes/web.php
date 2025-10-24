<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// ========================================
// 📦 Import Controller
// ========================================

// Controller Umum
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Auth\LoginController;

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
// 🔍 Cek Koneksi Database (Modul 9 Bagian A)
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
// 🌐 Halaman Publik
// ========================================
Route::get('/', [SiteController::class, 'homeindex']);
Route::get('/layanan', [SiteController::class, 'layananindex']);
Route::get('/kontak', [SiteController::class, 'kontakindex']);

// ========================================
// 🔐 Login & Logout
// ========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ========================================
// 🔒 Area yang Butuh Login (middleware auth)
// ========================================
Route::middleware('auth')->group(function () {

    // Dashboard Administrator
    Route::get('administrator/dashboard', function () {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    })->name('administrator.dashboard');

    // Dashboard Dokter
    Route::get('dokter/dashboard', function () {
        $user = Auth::user();
        return view('dokter.dashboard', compact('user'));
    })->name('dokter.dashboard');

    // Dashboard Perawat
    Route::get('perawat/dashboard', function () {
        $user = Auth::user();
        return view('perawat.dashboard', compact('user'));
    })->name('perawat.dashboard');

    // Dashboard Resepsionis
    Route::get('resepsionis/dashboard', function () {
        $user = Auth::user();
        return view('resepsionis.dashboard', compact('user'));
    })->name('resepsionis.dashboard');

    // Dashboard Pemilik
    Route::get('pemilik/dashboard', function () {
        $user = Auth::user();
        return view('pemilik.dashboard', compact('user'));
    })->name('pemilik.dashboard');

    // ========================================
    // 🧩 ROUTE DATA MASTER (KHUSUS ADMIN)
    // ========================================
    Route::prefix('administrator')->name('admin.')->group(function () {

        // Halaman utama Data Master
        Route::view('/data-master', 'admin.data_master')->name('data.master');

        // Jenis Hewan
        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis.index');

        // Ras Hewan
        Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras.index');

        // Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

        // Kategori Klinis
        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategoriKlinis.index');

        // Kode Tindakan
        Route::get('/kode-tindakan', [KodeTindakanController::class, 'index'])->name('kode.index');

        // Pet
        Route::get('/pet', [PetController::class, 'index'])->name('pet.index');

        // Pemilik
        Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    });
});
