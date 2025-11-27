<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use Carbon\Carbon;

class DashboardResepsionisController extends Controller
{
    public function index()
    {
        // Hitung jumlah reservasi hari ini
        $reservasiHariIni = TemuDokter::whereDate('waktu_daftar', Carbon::today())
            ->count(); // <-- Variabel 1

        // Hitung jumlah reservasi menunggu
        $reservasiMenunggu = TemuDokter::where('status', 'Menunggu')
            ->count(); // <-- Variabel 2
            
        // Ambil 5 reservasi terbaru
        $reservasiTerbaru = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->take(5)
            ->get(); // <-- Variabel 3

        // PASTIKAN SEMUA VARIABEL ADA DI COMPACT
        return view('resepsionis.dashboard', compact('reservasiHariIni', 'reservasiMenunggu', 'reservasiTerbaru')); 
     
    }
}