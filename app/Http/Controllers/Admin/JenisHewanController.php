<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisHewan;
use Illuminate\Http\Request;

class JenisHewanController extends Controller
{
    public function index()
    {
        $jenisHewan = JenisHewan::all();
        return view('admin.jenis_hewan.index', compact('jenisHewan'));
    }

    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateJenisHewan($request);
        $this->createJenisHewan($validated);
        return redirect()->route('admin.jenis.index')->with('success', '✅ Jenis hewan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $jenis = JenisHewan::findOrFail($id);
        return view('admin.jenis_hewan.edit', compact('jenis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request);
        $jenis = JenisHewan::findOrFail($id);
        $jenis->nama_jenis_hewan = $this->formatNamaJenisHewan($validated['nama_jenis_hewan']);
        $jenis->save();

        return redirect()->route('admin.jenis.index')->with('success', '✅ Jenis hewan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $jenis = JenisHewan::findOrFail($id);
        $jenis->delete();

        return redirect()->route('admin.jenis.index')->with('success', '🗑️ Jenis hewan berhasil dihapus!');
    }

    // 🔒 Private Helper Functions
    private function validateJenisHewan(Request $request)
    {
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,' . $request->idjenis_hewan . ',idjenis_hewan',
        ]);
    }

    private function createJenisHewan($data)
    {
        JenisHewan::create([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
        ]);
    }

    private function formatNamaJenisHewan($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}
