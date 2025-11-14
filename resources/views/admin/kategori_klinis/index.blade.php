@extends('layouts.lte.main') 

@section('title', 'Data Kategori Klinis') 

@section('content') 

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Kategori Klinis</h1> 
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                                <li class="breadcrumb-item"><a href="{{ route('admin.data.master') }}">Master Data</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">Kategori Klinis</li> 
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    
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
                            <h3 class="card-title">Tabel Data Kategori Klinis</h3>
                            <div class="card-tools">
                                 <a href="{{ route('admin.kategoriKlinis.create') }}" class="btn btn-sm btn-success">
                                     <i class="bi bi-plus-lg"></i> Tambah Kategori Klinis
                                 </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID</th> 
                                        <th>Nama Kategori Klinis</th>
                                        <th style="width: 120px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kategoriKlinis as $k) 
                                    <tr>
                                        <td>{{ $k->idkategori_klinis }}</td> 
                                        <td>{{ $k->nama_kategori_klinis }}</td>
                                        <td>
                                            {{-- Tombol Edit yang memicu modal --}}
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-kategoriklinis"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editKategoriKlinisModal"
                                                    data-id="{{ $k->idkategori_klinis }}"
                                                    data-nama="{{ $k->nama_kategori_klinis }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.kategoriKlinis.destroy', $k->idkategori_klinis) }}" 
                                                    method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                         onclick="return confirm('Anda yakin ingin menghapus data ini?')"> 
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="text-center">Belum ada data kategori klinis.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{-- Pagination --}}
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

<div class="modal fade" id="editKategoriKlinisModal" tabindex="-1" aria-labelledby="editKategoriKlinisModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriKlinisModalLabel">✏️ Edit Kategori Klinis</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKategoriKlinisForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    {{-- Nama Kategori Klinis --}}
                    <div class="mb-3">
                        <label for="edit_nama_kategori_klinis" class="form-label">Nama Kategori Klinis</label>
                        <input type="text" class="form-control" id="edit_nama_kategori_klinis" name="nama_kategori_klinis" required>
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
        
        const form = document.getElementById('editKategoriKlinisForm');
        const inputNama = document.getElementById('edit_nama_kategori_klinis');

        const updateRouteTemplate = "{{ route('admin.kategoriKlinis.update', ':id') }}";

        document.querySelectorAll('.btn-edit-kategoriklinis').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                
                inputNama.value = nama;

                form.action = updateRouteTemplate.replace(':id', id);
            });
        });
    });
</script>
@endpush