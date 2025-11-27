<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\DB;

class DataPasienDokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $iddokter = optional($user->dokter)->iddokter;

        if (!$iddokter) {
            return redirect()->route('dokter.dashboard')->with('error', 'Data Dokter tidak ditemukan.');
        }

        $pemilikIds = RekamMedis::select('pet.idpemilik')
            ->join('temu_dokter', 'rekam_medis.idreservasi_dokter', '=', 'temu_dokter.idreservasi_dokter')
            ->join('pet', 'temu_dokter.idpet', '=', 'pet.idpet')
            ->where('rekam_medis.dokter_pemeriksa', $iddokter)
            ->distinct()
            ->pluck('idpemilik');

        $pemilikList = Pemilik::whereIn('idpemilik', $pemilikIds)
            ->with([
                'user',
                'pet' => function($query) use ($pemilikIds) {

                    $query->with(['jenis', 'ras']);
                }
            ])
            ->get();
        
        return view('dokter.data_pasien.index', compact('pemilikList'));
    }
}