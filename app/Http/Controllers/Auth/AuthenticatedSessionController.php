<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses login dan redirect sesuai role user.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();
        $role = $user?->activeRole();

        if ($role) {
            switch ($role->nama_role) {
                case 'Administrator':
                    return redirect()->route('administrator.dashboard');
                case 'Dokter':
                    return redirect()->route('dokter.dashboard');
                case 'Perawat':
                    return redirect()->route('perawat.dashboard');
                case 'Resepsionis':
                    return redirect()->route('resepsionis.dashboard');
                case 'Pemilik':
                    return redirect()->route('pemilik.dashboard');
                default:
                    // kalau role-nya gak cocok, ke halaman default admin aja
                    return redirect()->route('administrator.dashboard');
            }
        }

        // fallback kalau user tidak punya role aktif
        return redirect()->route('administrator.dashboard');
    }

    /**
     * Logout user.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
       $request->session()->regenerateToken();

        return redirect('/');
    }
}
