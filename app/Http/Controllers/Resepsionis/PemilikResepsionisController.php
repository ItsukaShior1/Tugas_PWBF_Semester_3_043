<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PemilikResepsionisController extends Controller
{
    
    const ROLE_PEMILIK = 5; 

    public function index()
    {
        $pemilik = Pemilik::with('user')->paginate(10); // Gunakan paginasi
        return view('resepsionis.pemilik.create', compact('pemilik'));
    }

    public function create()
    {
        return view('resepsionis.pemilik.create');
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

        DB::beginTransaction();
        try {
        
            $user = User::create([
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            $user->roles()->attach(self::ROLE_PEMILIK);

            Pemilik::create([
                'iduser' => $user->iduser,
                'no_wa' => $validated['no_wa'],
                'alamat' => $validated['alamat'],
            ]);

            DB::commit();
            return redirect()->route('resepsionis.dashboard')->with('success', 'Pemilik berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan Pemilik: ' . $e->getMessage());
        }
    }
    
 
    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.pemilik.edit', compact('pemilik'));
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

        $pemilik->user->update([
            'nama' => $validated['nama'],
            'email' => $validated['email'],
        ]);

        $pemilik->update([
            'no_wa' => $validated['no_wa'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('resepsionis.pemilik.index')->with('success', 'Data pemilik berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        
        DB::beginTransaction();
        try {
    
            $pemilik->delete(); 
    
            if ($pemilik->user) {
                $pemilik->user->delete(); 
            }
            
            DB::commit();
            return redirect()->route('resepsionis.pemilik.index')->with('success', 'Data pemilik berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('resepsionis.pemilik.index')->with('error', 'Gagal menghapus pemilik: ' . $e->getMessage());
        }
    }
}