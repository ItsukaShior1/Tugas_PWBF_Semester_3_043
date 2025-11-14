@extends('layouts.lte.main')

@section('title', 'Data User')

@section('content')

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            {{-- Content Header --}}
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data User 👤</h1> 
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                               
                                <li class="breadcrumb-item"><a href="/administrator">Dashboard</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">User</li> 
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    
                    {{-- Notifikasi --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            ✅ {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            ❌ {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Daftar User Sistem</h3>
                            <div class="card-tools">
                               
                                 <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-success">
                                     <i class="bi bi-plus-lg"></i> Tambah User
                                 </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            {{-- Tabel --}}
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID</th> 
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Role Aktif</th>
                                        <th style="width: 150px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user) 
                                    <tr>
                                        <td>{{ $user->iduser }}</td> 
                                        <td>{{ $user->nama }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            <span class="badge bg-purple">
                                                {{ $user->activeRole()?->nama_role ?? 'Belum ada role' }}
                                            </span>
                                        </td>
                                        <td>
                                          
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-user"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editUserModal"
                                                    data-id="{{ $user->iduser }}"
                                                    data-nama="{{ $user->nama }}"
                                                    data-email="{{ $user->email }}"
                                                    data-role-id="{{ $user->activeRole()?->idrole ?? '' }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.user.destroy', $user->iduser) }}" 
                                                    method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                         onclick="return confirm('Anda yakin ingin menghapus user ini?')"> 
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada data user.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                           
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <a href="{{ route('admin.data.master') }}" 
                            class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Data Master
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editUserModalLabel">✏️ Edit Data User & Role</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editUserForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    
                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama User:</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>

                    {{-- Role Aktif --}}
                    <div class="mb-3">
                        <label for="edit_role" class="form-label">Role Aktif:</label>
                        <select class="form-select" id="edit_role" name="idrole">
                            <option value="">-- Belum ada role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->idrole }}">{{ $role->nama_role }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Perubahan role akan aktif setelah user login kembali.</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        
        const form = document.getElementById('editUserForm');
        
        const updateRouteTemplate = "{{ route('admin.user.update', ':id') }}";

        document.querySelectorAll('.btn-edit-user').forEach(button => {
            button.addEventListener('click', function() {

                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const email = this.getAttribute('data-email');
                const roleId = this.getAttribute('data-role-id');

                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_role').value = roleId; 
                
                form.action = updateRouteTemplate.replace(':id', id);
            });
        });
    });
</script>
@endpush