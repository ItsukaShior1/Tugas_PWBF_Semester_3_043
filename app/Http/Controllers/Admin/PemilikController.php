<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->get();
        return view('admin.pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('admin.pemilik.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        $user = User::create([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Pemilik::create([
            'iduser' => $user->iduser,
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Pemilik berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email,' . $pemilik->user->iduser . ',iduser',
            'no_wa' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
        ]);

        // update user
        $pemilik->user->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
        ]);

        // update pemilik
        $pemilik->update([
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        if ($pemilik->user) {
            $pemilik->user->delete();
        }
        $pemilik->delete();

        return redirect()->route('admin.pemilik.index')->with('success', 'Data pemilik berhasil dihapus!');
    }
}
