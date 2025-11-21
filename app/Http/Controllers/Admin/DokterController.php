<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DokterController extends Controller
{
    public function index()
    {
        $dokter = Dokter::with('user')->get();
        return view('admin.dokter.index', compact('dokter'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'bidang_dokter' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {

            $user = User::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            DB::table('role_user')->insert([
                'iduser' => $user->iduser,
                'idrole' => 2,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            Dokter::create([
                'iduser' => $user->iduser,
                'no_hp' => $validated['no_hp'],
                'alamat' => $validated['alamat'],
                'jenis_kelamin' => $validated['jenis_kelamin'],
                'bidang_dokter' => $validated['bidang_dokter'],
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Dokter berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan dokter: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $dokter = Dokter::with('user')->findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $dokter->user->iduser . ',iduser',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'bidang_dokter' => 'required|string|max:100',
        ]);

        // UPDATE USER
        $dokter->user->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
        ]);

        // UPDATE DOKTER
        $dokter->update([
            'no_hp' => $validated['no_hp'],
            'alamat' => $validated['alamat'],
            'jenis_kelamin' => $validated['jenis_kelamin'],
            'bidang_dokter' => $validated['bidang_dokter'],
        ]);

        return redirect()->back()->with('success', 'Data dokter berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $dokter = Dokter::findOrFail($id);

            // hapus role_user
            DB::table('role_user')->where('iduser', $dokter->iduser)->delete();

            // hapus user
            if ($dokter->user) {
                $dokter->user->delete();
            }

            // hapus dokter
            $dokter->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Dokter berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menghapus dokter: ' . $e->getMessage());
        }
    }
}
