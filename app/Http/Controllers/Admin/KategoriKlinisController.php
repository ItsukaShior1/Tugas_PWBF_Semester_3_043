<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriKlinis;
use Illuminate\Http\Request;

class KategoriKlinisController extends Controller
{
    public function index()
    {
        $kategoriKlinis = KategoriKlinis::all();
        return view('admin.kategori_klinis.index', compact('kategoriKlinis'));
    }

    public function create()
    {
        return view('admin.kategori_klinis.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis',
        ]);

        KategoriKlinis::create($validated);

        return redirect()->route('admin.kategoriKlinis.index')->with('success', 'Kategori Klinis berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $kategori = KategoriKlinis::findOrFail($id);

        $validated = $request->validate([
            'nama_kategori_klinis' => 'required|string|max:100|unique:kategori_klinis,nama_kategori_klinis,' . $id . ',idkategori_klinis',
        ]);

        $kategori->update($validated);

        return redirect()->route('admin.kategoriKlinis.index')->with('success', 'Kategori Klinis berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kategori = KategoriKlinis::findOrFail($id);
        $kategori->delete();

        return redirect()->route('admin.kategoriKlinis.index')->with('success', 'Kategori Klinis berhasil dihapus!');
    }
}
