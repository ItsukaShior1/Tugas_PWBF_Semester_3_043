<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\{
    JenisHewanController,
    RasHewanController,
    KategoriController,
    KategoriKlinisController,
    KodeTindakanController,
    PetController,
    PemilikController,
    UserController
};

require __DIR__.'/auth.php';


Route::get('/', [SiteController::class, 'homeindex'])->name('home');
Route::get('/layanan', [SiteController::class, 'layananindex'])->name('layanan');
Route::get('/kontak', [SiteController::class, 'kontakindex'])->name('kontak');


Route::get('/cek-koneksi', function () {
    try {
        DB::connection()->getPdo();
        $dbName = DB::connection()->getDatabaseName();
        return "✅ Koneksi ke database <strong>{$dbName}</strong> berhasil!";
    } catch (\Exception $e) {
        return "❌ Koneksi gagal: " . $e->getMessage();
    }
});


Route::middleware('auth')->group(function () {

    // Dashboard per role
    Route::get('administrator/dashboard', fn() => view('admin.dashboard', ['user' => Auth::user()]))->name('administrator.dashboard');
    Route::get('dokter/dashboard', fn() => view('dokter.dashboard', ['user' => Auth::user()]))->name('dokter.dashboard');
    Route::get('perawat/dashboard', fn() => view('perawat.dashboard', ['user' => Auth::user()]))->name('perawat.dashboard');
    Route::get('resepsionis/dashboard', fn() => view('resepsionis.dashboard', ['user' => Auth::user()]))->name('resepsionis.dashboard');
    Route::get('pemilik/dashboard', fn() => view('pemilik.dashboard', ['user' => Auth::user()]))->name('pemilik.dashboard');

    
    Route::prefix('administrator')->name('admin.')->group(function () {
        Route::view('/data-master', 'admin.data_master')->name('data.master');

        //CRUD Jenis Hewan
        Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis.index');
        Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis.create');
        Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis.store');
        Route::get('/jenis-hewan/{id}/edit', [JenisHewanController::class, 'edit'])->name('jenis.edit');
        Route::put('/jenis-hewan/{id}/update', [JenisHewanController::class, 'update'])->name('jenis.update');
        Route::delete('/jenis-hewan/{id}/delete', [JenisHewanController::class, 'destroy'])->name('jenis.destroy');

        //CRUD Ras Hewan
        Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras.index');
        Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras.create');
        Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras.store');
        Route::put('/ras-hewan/{id}/update', [RasHewanController::class, 'update'])->name('ras.update');
        Route::delete('/ras-hewan/{id}/delete', [RasHewanController::class, 'destroy'])->name('ras.destroy');

        //CRUD User
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
        Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

        //CRUD Kategori
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::put('/kategori/{id}/update', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}/delete', [KategoriController::class, 'destroy'])->name('kategori.destroy');

        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategoriKlinis.index');
        Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategoriKlinis.create');
        Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategoriKlinis.store');
        Route::put('/kategori-klinis/{id}/update', [KategoriKlinisController::class, 'update'])->name('kategoriKlinis.update');
        Route::delete('/kategori-klinis/{id}/delete', [KategoriKlinisController::class, 'destroy'])->name('kategoriKlinis.destroy');

        // CRUD Pet
        Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
        Route::get('/pet/create', [PetController::class, 'create'])->name('pet.create');
        Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
        Route::put('/pet/{id}/update', [PetController::class, 'update'])->name('pet.update');
        Route::delete('/pet/{id}/delete', [PetController::class, 'destroy'])->name('pet.destroy');
        // CRUD Kode Tindakan
        Route::get('/kode-tindakan', [KodeTindakanController::class, 'index'])->name('kode.index');
        Route::get('/kode-tindakan/create', [KodeTindakanController::class, 'create'])->name('kode.create');
        Route::post('/kode-tindakan/store', [KodeTindakanController::class, 'store'])->name('kode.store');
        Route::put('/kode-tindakan/{id}/update', [KodeTindakanController::class, 'update'])->name('kode.update');
        Route::delete('/kode-tindakan/{id}/delete', [KodeTindakanController::class, 'destroy'])->name('kode.destroy');

        Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
        Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('pemilik.create');
        Route::post('/pemilik/store', [PemilikController::class, 'store'])->name('pemilik.store');
        Route::put('/pemilik/{id}/update', [PemilikController::class, 'update'])->name('pemilik.update');
        Route::delete('/pemilik/{id}/delete', [PemilikController::class, 'destroy'])->name('pemilik.destroy');

       
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategoriKlinis.index');
        Route::get('/kode-tindakan', [KodeTindakanController::class, 'index'])->name('kode.index');
        Route::get('/pet', [PetController::class, 'index'])->name('pet.index');
        Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
    });

    // 🧍‍♂️ Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
