<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardPerawatController extends Controller
{
    /**
     * Menampilkan dashboard perawat. 
     */
    public function index()
    {
        $user = Auth::user();

        $reservasiHariIni = TemuDokter::whereDate('waktu_daftar', Carbon::today())
                                    ->whereIn('status', ['Menunggu', 'Proses'])
                                    ->count();

        $reservasiProses = TemuDokter::where('status', 'Proses')->count();
        
        $totalRekamMedis = RekamMedis::count();

        $reservasiSelesaiTanpaRM = TemuDokter::where('status', 'Selesai')
            ->doesntHave('rekamMedis')
            ->count();
            
        $data = [
            'user' => $user,
            'reservasiHariIni' => $reservasiHariIni,
            'reservasiProses' => $reservasiProses,
            'totalRekamMedis' => $totalRekamMedis,
            'reservasiSelesaiTanpaRM' => $reservasiSelesaiTanpaRM,
        ];

        return view('perawat.dashboard', $data);
    }
}