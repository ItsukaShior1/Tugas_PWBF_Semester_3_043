<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DetailRekamMedis;
use App\Models\RekamMedis;
use App\Models\KodeTindakan; // Menggunakan Model KodeTindakan sesuai konfirmasi

class DetailRekamMedisController extends Controller
{
 
    public function create($idrekam_medis)
    {
        $rekam = RekamMedis::findOrFail($idrekam_medis);
        
        if (optional(Auth::user()->dokter)->iddokter !== $rekam->iddokter_pemeriksa) {
            return back()->with('error', 'Anda tidak memiliki akses untuk menambah detail pada rekam medis ini.');
        }

        $kodeTindakanList = KodeTindakan::all(); 
        
        return view('dokter.rekam_medis.detail_create', compact('rekam', 'kodeTindakanList'));
    }

   
    public function store(Request $request, $idrekam_medis)
    {
        $rekam = RekamMedis::findOrFail($idrekam_medis);
        
        if (optional(Auth::user()->dokter)->iddokter !== $rekam->iddokter_pemeriksa) {
            return back()->with('error', 'Akses ditolak.');
        }

        $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi', 
            'detail' => 'nullable|string|max:1000',
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $idrekam_medis,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);

        return redirect()->route('dokter.rekamMedis.show', $idrekam_medis)
                         ->with('success', 'Detail tindakan terapi berhasil ditambahkan.');
    }
    

    public function destroy(DetailRekamMedis $detailRekamMedi)
    {
        $rekam = $detailRekamMedi->rekamMedis;
        
        if (optional(Auth::user()->dokter)->iddokter !== $rekam->iddokter_pemeriksa) {
            return back()->with('error', 'Akses ditolak.');
        }

        $detailRekamMedi->delete();

        return redirect()->route('dokter.rekamMedis.show', $rekam->idrekam_medis)
                         ->with('success', 'Detail tindakan terapi berhasil dihapus.');
    }

}