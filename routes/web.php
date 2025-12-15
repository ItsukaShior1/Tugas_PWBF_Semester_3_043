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
    UserController,
    DokterController,
    PerawatController
};
use App\Http\Controllers\KlienController;
use App\Http\Controllers\Dokter\{RekamMedisDokterController
    ,DetailRekamMedisController,
    DataPasienDokterController    
};
use App\Http\Controllers\Resepsionis\{
    DashboardResepsionisController,
    PemilikResepsionisController,
    PetResepsionisController,
    TemuDokterController
};
use App\Http\Controllers\Perawat\{RekamMedisPerawatController,DashboardPerawatController};

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
    Route::get('administrator/dashboard', fn() => view('admin.dashboard', ['user' => Auth::user()]))
        ->middleware('role:1')->name('administrator.dashboard');

    Route::get('dokter/dashboard', fn() => view('dokter.dashboard', ['user' => Auth::user()]))
        ->middleware('role:2')->name('dokter.dashboard');

    Route::get('perawat/dashboard', [DashboardPerawatController::class, 'index'])
        ->middleware('role:3')->name('perawat.dashboard');

    Route::get('resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])
    ->middleware('role:4')->name('resepsionis.dashboard');

    Route::get('pemilik/dashboard', fn() => view('pemilik.dashboard', ['user' => Auth::user()]))
        ->middleware('role:5')->name('pemilik.dashboard');

    Route::prefix('resepsionis')->middleware(['auth', 'role:4'])->name('resepsionis.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardResepsionisController::class, 'index'])->name('dashboard');

    // CRUD Pemilik
    Route::resource('pemilik', PemilikResepsionisController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // CRUD Pet
    Route::resource('pet', PetResepsionisController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);

    // CRUD Temu Dokter (Reservasi)
    Route::resource('temu_dokter', TemuDokterController::class);
});

    // --- Route Khusus Dokter (role:2) ---
    Route::middleware('role:2')->prefix('dokter')->name('dokter.')->group(function () {
        
        // Route Rekam Medis (Hanya View)
        Route::get('/rekam-medis', [RekamMedisDokterController::class, 'index'])->name('rekamMedis.index');
        Route::get('/rekam-medis/{id}', [RekamMedisDokterController::class, 'show'])->name('rekamMedis.show');
        
        // Route Data Pasien (View Pemilik dan Pet)
        Route::get('/data-pasien', [DataPasienDokterController::class, 'index'])->name('dataPasien.index');
        
        // CRUD Detail Rekam Medis (Dilakukan oleh Dokter)
        Route::prefix('rekam-medis/{idrekam_medis}/detail')->name('rekamMedis.detail.')->group(function () {
            Route::get('/create', [DetailRekamMedisController::class, 'create'])->name('create');
            Route::post('/store', [DetailRekamMedisController::class, 'store'])->name('store');
            Route::delete('/{detailRekamMedi}/delete', [DetailRekamMedisController::class, 'destroy'])->name('destroy');
        });
    });

    Route::middleware('role:3')->prefix('perawat')->name('perawat.')->group(function () {
        
        Route::resource('rekam-medis', RekamMedisPerawatController::class);

    });
    
    Route::middleware('role:5')->prefix('pemilik')->name('pemilik.')->group(function () {

        Route::get('/dashboard', [KlienController::class, 'dashboard'])->name('dashboard');
        Route::get('/pets', [KlienController::class, 'daftarPet'])->name('daftar_pet');
        Route::get('/reservasi', [KlienController::class, 'daftarReservasi'])->name('daftar_reservasi');
        Route::get('/rekam-medis', [KlienController::class, 'daftarRekamMedis'])->name('daftar_rekam_medis');
    });

    Route::middleware('role:1')->prefix('administrator')->name('admin.')->group(function () {

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

        // CRUD Perawat
        Route::get('/perawat', [PerawatController::class, 'index'])->name('perawat.index');
        Route::post('/perawat/store', [PerawatController::class, 'store'])->name('perawat.store');
        Route::put('/perawat/{id}/update', [PerawatController::class, 'update'])->name('perawat.update');
        Route::delete('/perawat/{id}/delete', [PerawatController::class, 'destroy'])->name('perawat.destroy');

        // CRUD Kategori Klinis
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

        // CRUD Pemilik
        Route::get('/pemilik', [PemilikController::class, 'index'])->name('pemilik.index');
        Route::get('/pemilik/create', [PemilikController::class, 'create'])->name('pemilik.create');
        Route::post('/pemilik/store', [PemilikController::class, 'store'])->name('pemilik.store');
        Route::put('/pemilik/{id}/update', [PemilikController::class, 'update'])->name('pemilik.update');
        Route::delete('/pemilik/{id}/delete', [PemilikController::class, 'destroy'])->name('pemilik.destroy');

        // CRUD Dokter
        Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
        Route::post('/dokter/store', [DokterController::class, 'store'])->name('dokter.store');
        Route::put('/dokter/{id}/update', [DokterController::class, 'update'])->name('dokter.update');
        Route::delete('/dokter/{id}/delete', [DokterController::class, 'destroy'])->name('dokter.destroy');

    });


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});