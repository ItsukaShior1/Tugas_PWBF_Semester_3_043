<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeTindakan;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KodeTindakanController extends Controller
{
    public function index()
    {
        $kodeTindakan = KodeTindakan::with(['kategori', 'kategoriKlinis'])->get();
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode_tindakan.index', compact('kodeTindakan', 'kategori', 'kategoriKlinis'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kode_tindakan.create', compact('kategori', 'kategoriKlinis'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kode_tindakan_terapi,kode',
            'deskripsi_tindakan_terapi' => 'required|string|max:255',
            'idkategori' => 'nullable|exists:kategori,idkategori',
            'idkategori_klinis' => 'nullable|exists:kategori_klinis,idkategori_klinis',
        ]);

        KodeTindakan::create($validated);

        return redirect()->route('admin.kode.index')->with('success', 'Kode tindakan berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kode = KodeTindakan::findOrFail($id);

        $validated = $request->validate([
            'kode' => 'required|string|max:50|unique:kode_tindakan_terapi,kode,' . $id . ',idkode_tindakan_terapi',
            'deskripsi_tindakan_terapi' => 'required|string|max:255',
            'idkategori' => 'nullable|exists:kategori,idkategori',
            'idkategori_klinis' => 'nullable|exists:kategori_klinis,idkategori_klinis',
        ]);

        $kode->update($validated);

        return redirect()->route('admin.kode.index')->with('success', 'Kode tindakan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kode = KodeTindakan::findOrFail($id);
        $kode->delete();

        return redirect()->route('admin.kode.index')->with('success', 'Kode tindakan berhasil dihapus!');
    }
}
