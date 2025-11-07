@extends('layouts.admin_layout')

@section('title', 'Data User')

@section('content')
<div class="container">
    <h2>👤 Data User</h2>
    <p>Daftar user yang terdaftar dalam sistem.</p>

    @if(session('success'))
        <div style="background:#e7ffe7; border-left:4px solid #28a745; padding:10px; margin-bottom:15px; color:#1d6f32;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.user.create') }}" 
       style="background:#7ed685; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
       + Tambah User
    </a>

    <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
        <thead>
            <tr style="background-color:#d072d0; color:white;">
                <th style="padding:8px;">ID</th>
                <th style="padding:8px;">Nama</th>
                <th style="padding:8px;">Email</th>
                <th style="padding:8px;">Role Aktif</th>
                <th style="padding:8px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:8px;">{{ $user->iduser }}</td>
                    <td style="padding:8px;">{{ $user->nama }}</td>
                    <td style="padding:8px;">{{ $user->email }}</td>
                    <td style="padding:8px;">
                        {{ $user->activeRole()->nama_role ?? 'Belum ada role' }}
                    </td>
                    <td style="padding:8px;">
                        <button onclick="openEditModal({{ $user->iduser }}, '{{ $user->nama }}', '{{ $user->email }}', {{ $user->activeRole()?->idrole ?? 'null' }})" 
                                style="color:#007bff; background:none; border:none; cursor:pointer;">
                            Edit
                        </button> |
                        <form action="{{ route('admin.user.destroy', $user->iduser) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background:none; border:none; color:red; cursor:pointer;" onclick="return confirm('Hapus user ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align:center; color:#999;">Belum ada data user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.data.master') }}" 
           style="background:#7ed685; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           ← Kembali ke Data Master
        </a>
    </div>
</div>

{{-- MODAL EDIT --}}
<div id="editModal" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:420px; position:relative;">
        <h3>✏️ Edit User</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label for="edit_nama">Nama:</label><br>
            <input type="text" id="edit_nama" name="nama" required
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px; margin-top:5px;"><br><br>

            <label for="edit_email">Email:</label><br>
            <input type="email" id="edit_email" name="email" required
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;"><br><br>

            <label for="edit_role">Role:</label><br>
            <select id="edit_role" name="idrole"
                    style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px;">
                <option value="">-- Belum ada role --</option>
                @foreach($roles as $role)
                    <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                @endforeach
            </select><br><br>

            <div style="text-align:right;">
                <button type="button" onclick="closeEditModal()" 
                        style="background:#aaa; color:white; padding:8px 12px; border:none; border-radius:5px; margin-right:5px;">
                    Batal
                </button>
                <button type="submit" 
                        style="background:#d072d0; color:white; padding:8px 12px; border:none; border-radius:5px;">
                    Simpan
                </button>
            </div>
        </form>

        <button onclick="closeEditModal()" 
                style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:18px; cursor:pointer;">
            ✖
        </button>
    </div>
</div>

<script>
    function openEditModal(id, nama, email, roleId) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = roleId ?? '';
        form.action = `/administrator/user/${id}/update`;
        modal.style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) closeEditModal();
    };
</script>
@endsection
