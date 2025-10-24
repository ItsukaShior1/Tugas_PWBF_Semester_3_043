<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    // Buat Show form login
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    // Buat Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Email atau password salah.');
        }

        Auth::login($user);

        $role = $user->activeRole();
        if (!$role) {
            Auth::logout();
            return back()->with('error', 'User tidak punya role aktif.');
        }

        // Mapping role ke route
        $roleRouteMap = [
            'Administrator' => 'administrator.dashboard',
            'Dokter'       => 'dokter.dashboard',
            'Perawat'      => 'perawat.dashboard',
            'Resepsionis'  => 'resepsionis.dashboard',
            'Pemilik'      => 'pemilik.dashboard',
        ];

        $roleName = $role->nama_role;

        if (!isset($roleRouteMap[$roleName])) {
            Auth::logout();
            return back()->with('error', 'Role tidak dikenali.');
        }

        
        return redirect()->route($roleRouteMap[$roleName]);
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
