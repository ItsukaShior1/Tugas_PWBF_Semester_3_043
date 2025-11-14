<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pet = DB::table('pet')
            ->join('ras_hewan', 'pet.idras_hewan', '=', 'ras_hewan.idras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->join('pemilik', 'pet.idpemilik', '=', 'pemilik.idpemilik')
            ->join('users', 'pemilik.iduser', '=', 'users.iduser')
            ->select(
                'pet.*',
                'ras_hewan.nama_ras',
                'jenis_hewan.nama_jenis_hewan',
                'users.nama as nama_pemilik'
            )
            ->get();

        $ras = DB::table('ras_hewan')
            ->join('jenis_hewan', 'ras_hewan.idjenis_hewan', '=', 'jenis_hewan.idjenis_hewan')
            ->select('ras_hewan.*', 'jenis_hewan.nama_jenis_hewan')
            ->get();

        $pemilik = DB::table('pemilik')
            ->join('users', 'pemilik.iduser', '=', 'users.iduser')
            ->select('pemilik.*', 'users.nama')
            ->get();

        return view('admin.pet.index', compact('pet', 'ras', 'pemilik'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'           => 'required|string|max:150',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required',
            'idras_hewan'    => 'required|integer',
            'idpemilik'      => 'required|integer',
        ]);

        DB::table('pet')->insert([
            'nama'           => $request->nama,
            'tanggal_lahir'  => $request->tanggal_lahir,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'warna_tanda'    => $request->warna_tanda ?? null,
            'idras_hewan'    => $request->idras_hewan,
            'idpemilik'      => $request->idpemilik,
        ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Pet berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'           => 'required|string|max:150',
            'tanggal_lahir'  => 'required|date',
            'jenis_kelamin'  => 'required',
            'idras_hewan'    => 'required|integer',
            'idpemilik'      => 'required|integer',
        ]);

        DB::table('pet')
            ->where('idpet', $id)
            ->update([
                'nama'           => $request->nama,
                'tanggal_lahir'  => $request->tanggal_lahir,
                'jenis_kelamin'  => $request->jenis_kelamin,
                'warna_tanda'    => $request->warna_tanda ?? null,
                'idras_hewan'    => $request->idras_hewan,
                'idpemilik'      => $request->idpemilik,
            ]);

        return redirect()->route('admin.pet.index')
            ->with('success', 'Data pet berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::table('pet')->where('idpet', $id)->delete();

        return redirect()
            ->route('admin.pet.index')
            ->with('success', 'Pet berhasil dihapus!');
    }
}
