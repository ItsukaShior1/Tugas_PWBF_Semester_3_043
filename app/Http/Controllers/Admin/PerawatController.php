<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Perawat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PerawatController extends Controller
{
    public function index()
    {
        $perawat = Perawat::with('user')->get();
        return view('admin.perawat.index', compact('perawat'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_perawat' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ]);

        // Insert user
        $user = User::create([
            'nama' => $request->nama_perawat,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // Insert role_user (idrole perawat = 3)
        DB::table('role_user')->insert([
            'iduser' => $user->iduser,
            'idrole' => 3,
        ]);

        // Insert perawat
        Perawat::create([
            'nama_perawat' => $request->nama_perawat,
            'iduser' => $user->iduser,
        ]);

        return redirect()->back()->with('success', 'Perawat berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $perawat = Perawat::findOrFail($id);
        $user = User::findOrFail($perawat->iduser);

        $request->validate([
            'nama_perawat' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->iduser . ',iduser',
        ]);

        // update user
        $user->update([
            'nama' => $request->nama_perawat,
            'email' => $request->email,
        ]);

        // update perawat
        $perawat->update([
            'nama_perawat' => $request->nama_perawat,
        ]);

        return redirect()->back()->with('success', 'Data perawat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $perawat = Perawat::findOrFail($id);
        $user = User::findOrFail($perawat->iduser);

        // hapus role user
        DB::table('role_user')->where('iduser', $user->iduser)->delete();

        // hapus user
        $user->delete();

        // hapus perawat
        $perawat->delete();

        return redirect()->back()->with('success', 'Perawat berhasil dihapus');
    }
}
