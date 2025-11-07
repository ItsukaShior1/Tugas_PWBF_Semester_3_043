<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RasHewan;
use App\Models\JenisHewan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RasHewanController extends Controller
{
    public function index()
    {
        $rasHewan = RasHewan::with('jenis')->get();
        $jenisList = JenisHewan::all();
        return view('admin.ras_hewan.index', compact('rasHewan', 'jenisList'));
    }

    public function create()
    {
        $jenisList = JenisHewan::all();
        return view('admin.ras_hewan.create', compact('jenisList'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateRasHewan($request);
        $this->createRasHewan($validated);
        return redirect()->route('admin.ras.index')->with('success', '✅ Ras hewan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateRasHewan($request, $id);
        $ras = RasHewan::findOrFail($id);
        $ras->update([
            'nama_ras' => $this->formatNamaRas($validated['nama_ras']),
            'idjenis_hewan' => $validated['idjenis_hewan'],
        ]);

        return redirect()->route('admin.ras.index')->with('success', '✏️ Data ras berhasil diperbarui!');
    }

    public function destroy($id)
    {
        RasHewan::findOrFail($id)->delete();
        return redirect()->route('admin.ras.index')->with('success', '🗑️ Ras hewan berhasil dihapus!');
    }

    // =============================
    // 🧩 PRIVATE HELPER FUNCTIONS
    // =============================
    private function validateRasHewan(Request $request, $id = null)
    {
        return $request->validate([
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'nama_ras' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ras_hewan', 'nama_ras')->ignore($id, 'idras_hewan'),
            ],
        ]);
    }

    private function createRasHewan($data)
    {
        RasHewan::create([
            'idjenis_hewan' => $data['idjenis_hewan'],
            'nama_ras' => $this->formatNamaRas($data['nama_ras']),
        ]);
    }

    private function formatNamaRas($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
