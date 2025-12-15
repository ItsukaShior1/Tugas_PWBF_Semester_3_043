<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Dokter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisPerawatController extends Controller
{
    private function getFormDependencies()
    {
        $reservasiTemu = TemuDokter::whereIn('status', ['Menunggu', 'Proses'])
            ->doesntHave('rekamMedis') 
            ->with('pet.pemilik.user')
            ->get();
            
        $dokterList = Dokter::with('user')->get();

        return compact('reservasiTemu', 'dokterList');
    }


    public function index()
    {
        $rekamList = RekamMedis::with([
            'reservasi.pet.pemilik.user', 
            'dokterPemeriksa.user'
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(15);
        
        $reservasiTemuCount = TemuDokter::whereIn('status', ['Menunggu', 'Proses'])
            ->doesntHave('rekamMedis')
            ->count();
            
        return view('perawat.rekam_medis.index', compact('rekamList', 'reservasiTemuCount'));
    }
    

    public function create()
    {
        $data = $this->getFormDependencies();
        
        if ($data['reservasiTemu']->isEmpty()) {
            return redirect()->route('perawat.rekam-medis.index')
                             ->with('error', 'Tidak ada reservasi Temu Dokter yang siap dibuat Rekam Medis baru.');
        }

        return view('perawat.rekam_medis.create', $data);
    }

  
    public function store(Request $request)
    {
        $validated = $request->validate([
            'idreservasi_dokter' => 'required|integer|exists:temu_dokter,idreservasi_dokter|unique:rekam_medis,idreservasi_dokter',
            'dokter_pemeriksa' => 'required|integer|exists:dokter,iddokter', 
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            RekamMedis::create([
                'idreservasi_dokter' => $validated['idreservasi_dokter'],
                'dokter_pemeriksa' => $validated['dokter_pemeriksa'], 
                'anamnesa' => $validated['anamnesa'],
                'temuan_klinis' => $validated['temuan_klinis'],
                'diagnosa' => $validated['diagnosa'],
            ]);

            TemuDokter::where('idreservasi_dokter', $validated['idreservasi_dokter'])
                ->update(['status' => 'Proses']);

            DB::commit();
            return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam Medis berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan Rekam Medis: ' . $e->getMessage())->withInput();
        }
    }
    
    
    public function show($idrekam_medis)
    {
        $rekamMedis = RekamMedis::with([
            'reservasi.pet.pemilik.user', 
            'dokterPemeriksa.user',
            'details.kodeTindakan',
            'details.kategoriKlinis'
        ])
        ->findOrFail($idrekam_medis);

        return view('perawat.rekam_medis.detail', compact('rekamMedis'));
    }

 
    public function edit($idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);
        $data = $this->getFormDependencies(); 

        return view('perawat.rekam_medis.edit', array_merge($data, compact('rekamMedis')));
    }


    
    public function update(Request $request, $idrekam_medis)
    {
        $rekamMedis = RekamMedis::findOrFail($idrekam_medis);

        $validated = $request->validate([
            'dokter_pemeriksa' => 'required|integer|exists:dokter,iddokter', 
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'required|string',
            'diagnosa' => 'required|string',
        ]);

        $rekamMedis->update([
            'dokter_pemeriksa' => $validated['dokter_pemeriksa'], 
            'anamnesa' => $validated['anamnesa'],
            'temuan_klinis' => $validated['temuan_klinis'],
            'diagnosa' => $validated['diagnosa'],
        ]);

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam Medis berhasil diperbarui.');
    }

    public function destroy($idrekam_medis)
    {
        RekamMedis::findOrFail($idrekam_medis)->delete();
        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam Medis berhasil dihapus.');
    }
}