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
      
        $reservasiHariIni = TemuDokter::whereDate('waktu_daftar', Carbon::today())
            ->count(); // <-- Variabel 1

        
        $reservasiMenunggu = TemuDokter::where('status', 'Menunggu')
            ->count(); // <-- Variabel 2
            
        $reservasiTerbaru = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->take(5)
            ->get(); // <-- Variabel 3

        
        return view('resepsionis.dashboard', compact('reservasiHariIni', 'reservasiMenunggu', 'reservasiTerbaru')); 
     
    }
}