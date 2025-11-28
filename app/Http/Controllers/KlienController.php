<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Pet;
use App\Models\TemuDokter; // Asumsi model TemuDokter untuk temu_dokter
use App\Models\RekamMedis; // Asumsi model RekamMedis untuk rekam_medis

class KlienController extends Controller
{
    /**
     * Pastikan pengguna adalah Pemilik (idrole 5)
     */
    public function __construct()
    {
        // Anda mungkin perlu menambahkan middleware 'auth' dan 'role:5' di route/middleware
    }

    /**
     * Menampilkan Dashboard Pemilik
     */
    public function dashboard()
    {
        $user = Auth::user();

        // Pastikan user memiliki data pemilik
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            // Handle jika data pemilik tidak ditemukan
            return redirect('/logout')->withErrors('Data Pemilik tidak ditemukan. Silakan hubungi admin.');
        }

        // Ambil data statistik untuk dashboard
        $petCount = $pemilik->pet()->count();
        $reservasiCount = TemuDokter::whereHas('pet', function ($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })->where('status', 'MENUNGGU')->count();
        
        $reservasiTotal = TemuDokter::whereHas('pet', function ($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })->count();

        return view('pemilik.dashboard', compact('user', 'pemilik', 'petCount', 'reservasiCount', 'reservasiTotal'));
    }

    /**
     * Menampilkan Daftar Pet
     */
    public function daftarPet()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')->withErrors('Data Pemilik tidak ditemukan.');
        }

        // Mengambil pet milik pemilik, eager loading Ras dan JenisHewan
        $pets = $pemilik->pet()->with(['ras', 'jenisHewan'])->get();
        // Asumsi Pet model memiliki relasi public function ras() dan public function jenisHewan()

        return view('pemilik.daftar_pet', compact('user', 'pets'));
    }

    /**
     * Menampilkan Daftar Reservasi Temu Dokter
     */
    public function daftarReservasi()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')->withErrors('Data Pemilik tidak ditemukan.');
        }

        // Ambil data TemuDokter yang terhubung ke pet milik pemilik ini
        $reservasi = TemuDokter::whereHas('pet', function ($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })
        ->with('pet:idpet,nama') // Eager load nama pet (asumsi Pet model memiliki kolom 'nama')
        ->orderBy('waktu_daftar', 'DESC')
        ->get();

        return view('pemilik.daftar_reservasi', compact('user', 'reservasi'));
    }

    /**
     * Menampilkan Daftar Rekam Medis
     */
    public function daftarRekamMedis()
    {
        $user = Auth::user();
        $pemilik = $user->pemilik;

        if (!$pemilik) {
            return redirect()->route('pemilik.dashboard')->withErrors('Data Pemilik tidak ditemukan.');
        }

        // Ambil data Rekam Medis yang terhubung melalui TemuDokter ke pet milik pemilik ini
        $rekamMedis = RekamMedis::whereHas('temuDokter.pet', function ($query) use ($pemilik) {
            $query->where('idpemilik', $pemilik->idpemilik);
        })
        ->with('temuDokter.pet:idpet,nama') // Eager load nama pet melalui TemuDokter
        ->orderBy('created_at', 'DESC')
        ->get();

        return view('pemilik.daftar_rekam_medis', compact('user', 'rekamMedis'));
    }
}