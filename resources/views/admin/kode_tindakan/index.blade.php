@extends('layouts.lte.main') 

@section('title', 'Data Kode Tindakan') 

@section('content') 

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            {{-- Content Header --}}
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Kode Tindakan Terapi</h1> 
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                                <li class="breadcrumb-item"><a href="{{ route('admin.data.master') }}">Master Data</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">Kode Tindakan</li> 
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
                            <h3 class="card-title">Tabel Data Kode Tindakan</h3>
                            <div class="card-tools">
                                 <a href="{{ route('admin.kode.create') }}" class="btn btn-sm btn-success">
                                     <i class="bi bi-plus-lg"></i> Tambah Kode Tindakan
                                 </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Tabel --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID</th> 
                                        <th style="width: 100px;">Kode</th>
                                        <th>Deskripsi</th>
                                        <th style="width: 150px;">Kategori</th>
                                        <th style="width: 150px;">Kategori Klinis</th>
                                        <th style="width: 120px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($kodeTindakan as $kode) 
                                    <tr>
                                        <td>{{ $kode->idkode_tindakan_terapi }}</td> 
                                        <td>{{ $kode->kode }}</td>
                                        <td>{{ $kode->deskripsi_tindakan_terapi }}</td>
                                        <td>{{ $kode->kategori->nama_kategori ?? '-' }}</td>
                                        <td>{{ $kode->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                                        <td>
                                            
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-kode"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editKodeTindakanModal"
                                                    data-id="{{ $kode->idkode_tindakan_terapi }}"
                                                    data-kode="{{ $kode->kode }}"
                                                    data-deskripsi="{{ $kode->deskripsi_tindakan_terapi }}"
                                                    data-idkategori="{{ $kode->idkategori }}"
                                                    data-idkategoriklinis="{{ $kode->idkategori_klinis }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.kode.destroy', $kode->idkode_tindakan_terapi) }}" 
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
                                        <td colspan="6" class="text-center">Belum ada data kode tindakan.</td>
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


<div class="modal fade" id="editKodeTindakanModal" tabindex="-1" aria-labelledby="editKodeTindakanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKodeTindakanModalLabel">✏️ Edit Kode Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editKodeTindakanForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    {{-- Kode --}}
                    <div class="mb-3">
                        <label for="edit_kode" class="form-label">Kode</label>
                        <input type="text" class="form-control" id="edit_kode" name="kode" required>
                    </div>
                    
                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="edit_deskripsi" class="form-label">Deskripsi Tindakan</label>
                        <textarea class="form-control" id="edit_deskripsi" name="deskripsi_tindakan_terapi" rows="3" required></textarea>
                    </div>
                    
                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label for="edit_idkategori" class="form-label">Kategori</label>
                        <select id="edit_idkategori" name="idkategori" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Kategori Klinis --}}
                    <div class="mb-3">
                        <label for="edit_idkategori_klinis" class="form-label">Kategori Klinis</label>
                        <select id="edit_idkategori_klinis" name="idkategori_klinis" class="form-select" required>
                            <option value="">-- Pilih Kategori Klinis --</option>
                            @foreach($kategoriKlinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                            @endforeach
                        </select>
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
        
        const form = document.getElementById('editKodeTindakanForm');
        const inputKode = document.getElementById('edit_kode');
        const inputDeskripsi = document.getElementById('edit_deskripsi');
        const selectKategori = document.getElementById('edit_idkategori');
        const selectKategoriKlinis = document.getElementById('edit_idkategori_klinis');

        const updateRouteTemplate = "{{ route('admin.kode.update', ':id') }}";

        document.querySelectorAll('.btn-edit-kode').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const kode = this.getAttribute('data-kode');
                const deskripsi = this.getAttribute('data-deskripsi');
                const idkategori = this.getAttribute('data-idkategori');
                const idkategoriklinis = this.getAttribute('data-idkategoriklinis');
                
                inputKode.value = kode;
                inputDeskripsi.value = deskripsi;
                selectKategori.value = idkategori;
                selectKategoriKlinis.value = idkategoriklinis;

                form.action = updateRouteTemplate.replace(':id', id);
            });
        });
    });
</script>
@endpush