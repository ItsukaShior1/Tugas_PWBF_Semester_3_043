<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\RasHewan;
use App\Models\Pemilik;
use Illuminate\Http\Request;

class PetResepsionisController extends Controller
{
    public function index()
    {
        $petList = Pet::with(['ras.jenis', 'pemilik.user'])->paginate(10);
        
        
        $ras = RasHewan::with('jenis')->get();
        $pemilik = Pemilik::with('user')->get();

        return view('resepsionis.pet.index', compact('petList', 'ras', 'pemilik'));
    }

    public function create()
    {
        $ras = RasHewan::with('jenis')->get();
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pet.create', compact('ras', 'pemilik'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_hewan' => 'required|string|max:150',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:J,B', // J=Jantan, B=Betina
            'berat' => 'nullable|numeric', 
            'idras_hewan' => 'required|integer|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|integer|exists:pemilik,idpemilik',
        ]);

        Pet::create($validated);

        return redirect()->route('resepsionis.pet.index')->with('success', 'Pet berhasil ditambahkan!');
    }
    


    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $ras = RasHewan::with('jenis')->get();
        $pemilik = Pemilik::with('user')->get();
        return view('resepsionis.pet.edit', compact('pet', 'ras', 'pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);
        
        $validated = $request->validate([
            'nama_hewan' => 'required|string|max:150',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:J,B', 
            'berat' => 'nullable|numeric', 
            'idras_hewan' => 'required|integer|exists:ras_hewan,idras_hewan',
            'idpemilik' => 'required|integer|exists:pemilik,idpemilik',
        ]);

        $pet->update($validated);

        return redirect()->route('resepsionis.pet.index')->with('success', 'Data pet berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Pet::findOrFail($id)->delete();
        return redirect()->route('resepsionis.pet.index')->with('success', 'Pet berhasil dihapus!');
    }
}