<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Dokter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuList = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->paginate(15);
            
        return view('resepsionis.temu_dokter.index', compact('temuList'));
    }

    public function create()
    {
        $pets = Pet::with('pemilik.user')->get();
        $dokter = Dokter::with('user')->get();
        
        return view('resepsionis.temu_dokter.create', compact('pets', 'dokter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'idpet' => 'required|integer|exists:pet,idpet',
            'iddokter' => 'nullable|integer|exists:dokter,iddokter', 
            'status' => 'required|in:Menunggu,Proses,Selesai,Batal',
        ]);

       
        $lastTemu = TemuDokter::whereDate('waktu_daftar', Carbon::today())
            ->orderBy('no_urut', 'desc')
            ->first();

        $noUrutBaru = ($lastTemu) ? $lastTemu->no_urut + 1 : 1;

        TemuDokter::create([
            'idpet' => $validated['idpet'],
            'iddokter' => $validated['iddokter'] ?? null,
            'no_urut' => $noUrutBaru,
            'waktu_daftar' => Carbon::now(),
            'status' => $validated['status'],
        ]);

        return redirect()->route('resepsionis.temu_dokter.index')->with('success', 'Reservasi temu dokter berhasil dibuat!');
    }

   
    public function update(Request $request, $id)
    {
        $temu = TemuDokter::findOrFail($id);
        
        $validated = $request->validate([
            'idpet' => 'required|integer|exists:pet,idpet',
            'iddokter' => 'nullable|integer|exists:dokter,iddokter',
            'status' => 'required|in:Menunggu,Proses,Selesai,Batal',
        
        ]);

        $temu->update($validated);

        return redirect()->route('resepsionis.temu_dokter.index')->with('success', 'Data temu dokter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        TemuDokter::findOrFail($id)->delete();
        return redirect()->route('resepsionis.temu_dokter.index')->with('success', 'Reservasi berhasil dihapus!');
    }
    public function edit($id)
{
    $temu = TemuDokter::findOrFail($id);
    $pets = Pet::with('pemilik.user')->get(); 
    $dokter = Dokter::with('user')->get(); 

    return view('resepsionis.temu_dokter.edit', compact('temu', 'pets', 'dokter'));
}
}