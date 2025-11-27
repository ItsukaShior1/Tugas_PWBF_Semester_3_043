<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\Dokter;

class RekamMedisDokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $iddokter = optional($user->dokter)->iddokter;
        
        if (!$iddokter) {
            return redirect()->route('dokter.dashboard')->with('error', 'Data Dokter tidak ditemukan.');
        }
        
        $rekamList = RekamMedis::where('dokter_pemeriksa', $iddokter)
            ->with([
                'reservasi.pet.pemilik.user', 
                'dokterPemeriksa.user'
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('dokter.rekam_medis.index', compact('rekamList'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $iddokter = optional($user->dokter)->iddokter;

        $rekam = RekamMedis::where('idrekam_medis', $id)
            ->where('dokter_pemeriksa', $iddokter)
            ->with([
                'reservasi.pet.pemilik.user',
                'dokterPemeriksa.user',
                'details.kodeTindakanTerapi.kategori', 
                'details.kodeTindakanTerapi.kategoriKlinis'
            ])
            ->firstOrFail();

        $details = $rekam->details;

        return view('dokter.rekam_medis.detail', compact('rekam', 'details'));
    }
}