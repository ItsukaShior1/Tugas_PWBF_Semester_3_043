<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('admin.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', 
        ]);

        User::create([
            'nama' => trim($validated['nama']),
            'email' => strtolower($validated['email']),
            'password' => $validated['password'],
        ]);

        return redirect()->route('admin.user.index')->with('success', '✅ User berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nama' => 'required|string|max:100',
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($id, 'iduser')],
            'idrole' => 'nullable|exists:roles,idrole',
        ]);

        $user->update([
            'nama' => trim($validated['nama']),
            'email' => strtolower($validated['email']),
        ]);

        if (!empty($validated['idrole'])) {
            RoleUser::where('iduser', $user->iduser)->update(['status' => 0]);
            RoleUser::updateOrCreate(
                ['iduser' => $user->iduser, 'idrole' => $validated['idrole']],
                ['status' => 1]
            );
        }

        return redirect()->route('admin.user.index')->with('success', '✏️ Data user berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        RoleUser::where('iduser', $id)->delete();
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', '🗑️ User berhasil dihapus!');
    }
}
