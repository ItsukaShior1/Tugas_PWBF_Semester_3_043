<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Exception; 

class JenisHewanController extends Controller
{
    public function index()
    {

        $jenisHewan = DB::table('jenis_hewan')
            ->select('idjenis_hewan', 'nama_jenis_hewan')
            ->get(); 

        return view('admin.jenis_hewan.index', compact('jenisHewan')); 
    }

    public function create()
    {
        return view('admin.jenis_hewan.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $this->validateJenisHewan($request);
            $this->createJenisHewan($validated); 
            return redirect()->route('admin.jenis.index')->with('success', '✅ Jenis hewan berhasil ditambahkan!');
        } catch (Exception $e) {
 
             return redirect()->route('admin.jenis.index')->with('error', '❌ Gagal menambahkan jenis hewan: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $jenis = DB::table('jenis_hewan')
                 ->where('idjenis_hewan', $id)
                 ->first();
        
        if (!$jenis) {
            abort(404); 
        }
        
        return view('admin.jenis_hewan.edit', compact('jenis'));
    }

    public function update(Request $request, $id)
    {
        $validated = $this->validateJenisHewan($request);
        
        DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->update([
                'nama_jenis_hewan' => $this->formatNamaJenisHewan($validated['nama_jenis_hewan']),

            ]);

        return redirect()->route('admin.jenis.index')->with('success', '✅ Jenis hewan berhasil diperbarui!');
    }

    public function destroy($id)
    {

        $deleted = DB::table('jenis_hewan')
            ->where('idjenis_hewan', $id)
            ->delete();

        if ($deleted) {
            return redirect()->route('admin.jenis.index')->with('success', '🗑️ Jenis hewan berhasil dihapus!');
        } else {
            return redirect()->route('admin.jenis.index')->with('error', '❌ Gagal menghapus jenis hewan.');
        }
    }

    private function validateJenisHewan(Request $request)
    {
        return $request->validate([
            'nama_jenis_hewan' => 'required|string|max:100|unique:jenis_hewan,nama_jenis_hewan,' . $request->idjenis_hewan . ',idjenis_hewan',
        ]);
    }

    private function createJenisHewan($data)
    { 
        return DB::table('jenis_hewan')->insert([
            'nama_jenis_hewan' => $this->formatNamaJenisHewan($data['nama_jenis_hewan']),
           
        ]);
    }

    private function formatNamaJenisHewan($nama)
    {
        return ucwords(strtolower(trim($nama)));
    }
}