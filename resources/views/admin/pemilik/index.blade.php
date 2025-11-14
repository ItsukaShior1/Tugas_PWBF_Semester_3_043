@extends('layouts.lte.main')

@section('title', 'Data Pemilik')

@section('content')

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            {{-- Content Header --}}
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Pemilik Hewan</h1> 
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                                <li class="breadcrumb-item"><a href="{{ route('admin.data.master') }}">Master Data</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">Pemilik</li> 
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    
                    {{-- Notifikasi --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tabel Data Pemilik</h3>
                            <div class="card-tools">
                                 <a href="{{ route('admin.pemilik.create') }}" class="btn btn-sm btn-success">
                                     <i class="bi bi-plus-lg"></i> Tambah Pemilik
                                 </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Tabel --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID</th> 
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th style="width: 150px;">No. WA</th>
                                        <th>Alamat</th>
                                        <th style="width: 120px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pemilik as $p) 
                                    <tr>
                                        <td>{{ $p->idpemilik }}</td> 
                                        <td>{{ $p->user->nama ?? '-' }}</td>
                                        <td>{{ $p->user->email ?? '-' }}</td>
                                        <td>{{ $p->no_wa ?? '-' }}</td>
                                        <td>{{ $p->alamat ?? '-' }}</td>
                                        <td>
                                
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-pemilik"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editPemilikModal"
                                                    data-id="{{ $p->idpemilik }}"
                                                    data-nama="{{ $p->user->nama ?? '' }}"
                                                    data-email="{{ $p->user->email ?? '' }}"
                                                    data-no-wa="{{ $p->no_wa ?? '' }}"
                                                    data-alamat="{{ $p->alamat ?? '' }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" 
                                                    method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                         onclick="return confirm('Anda yakin ingin menghapus data pemilik ini?')"> 
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada data pemilik.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                      
                        </div>
                    </div>
                    
                    {{-- Tombol Kembali ke Data Master --}}
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


<div class="modal fade" id="editPemilikModal" tabindex="-1" aria-labelledby="editPemilikModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPemilikModalLabel">✏️ Edit Data Pemilik</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPemilikForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    
                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>
                    
                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    
                    {{-- No. WA --}}
                    <div class="mb-3">
                        <label for="edit_no_wa" class="form-label">No. WA</label>
                        <input type="text" class="form-control" id="edit_no_wa" name="no_wa" required>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="edit_alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
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
        
        
        const form = document.getElementById('editPemilikForm');
        const inputNama = document.getElementById('edit_nama');
        const inputEmail = document.getElementById('edit_email');
        const inputWa = document.getElementById('edit_no_wa');
        const inputAlamat = document.getElementById('edit_alamat');

        const updateRouteTemplate = "{{ route('admin.pemilik.update', ':id') }}";

        document.querySelectorAll('.btn-edit-pemilik').forEach(button => {
            button.addEventListener('click', function() {

                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const email = this.getAttribute('data-email');
                const noWa = this.getAttribute('data-no-wa');
                const alamat = this.getAttribute('data-alamat');
                
                inputNama.value = nama;
                inputEmail.value = email;
                inputWa.value = noWa;
                inputAlamat.value = alamat;

              
                form.action = updateRouteTemplate.replace(':id', id);
            });
        });
    });
</script>
@endpush