<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        $hasRole = DB::table('role_user')
            ->where('iduser', $user->iduser)
            ->where('idrole', $role)
            ->exists();

        if (!$hasRole) {
            abort(403, 'Anda tidak memiliki akses.');
        }

        return $next($request);
    }
}
