@extends('layouts.lte.main') 

@section('title', 'Data Ras Hewan') 

@section('content') 

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            {{-- Content Header --}}
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Ras Hewan</h1> 
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                                <li class="breadcrumb-item"><a href="{{ route('admin.data.master') }}">Master Data</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">Ras Hewan</li> 
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
                            <h3 class="card-title">Tabel Data Ras Hewan</h3>
                            <div class="card-tools">
                                 <a href="{{ route('admin.ras.create') }}" class="btn btn-sm btn-success">
                                     <i class="bi bi-plus-lg"></i> Tambah Ras Hewan
                                 </a>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Tabel --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                      
                                        <th style="width: 50px;">ID</th> 
                                        <th>Nama Ras</th>
                                        <th>Jenis Hewan</th>
                                      
                                        <th style="width: 120px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rasHewan as $ras) 
                                    <tr>
                                        <td>{{ $ras->idras_hewan }}</td> 
                                        <td>{{ $ras->nama_ras }}</td>
                                        <td>{{ $ras->jenis->nama_jenis_hewan ?? '-' }}</td>
                                        <td>
                                     
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-ras"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editRasHewanModal"
                                                    data-id="{{ $ras->idras_hewan }}"
                                                    data-nama="{{ $ras->nama_ras }}"
                                                    data-jenis="{{ $ras->idjenis_hewan }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.ras.destroy', $ras->idras_hewan) }}" 
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
                                        <td colspan="4" class="text-center">Belum ada data ras hewan.</td>
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

<div class="modal fade" id="editRasHewanModal" tabindex="-1" aria-labelledby="editRasHewanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editRasHewanModalLabel">✏️ Edit Ras Hewan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            {{-- Form akan diisi action-nya oleh JavaScript --}}
            <form id="editRasHewanForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    {{-- Nama Ras --}}
                    <div class="mb-3">
                        <label for="edit_nama_ras" class="form-label">Nama Ras</label>
                        <input type="text" class="form-control" id="edit_nama_ras" name="nama_ras" required>
                    </div>
                    
                    {{-- Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="edit_idjenis_hewan" class="form-label">Jenis Hewan</label>
                        <select id="edit_idjenis_hewan" name="idjenis_hewan" class="form-select" required>
                    
                            @foreach($jenisList as $jenis)
                                <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
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
 
        const form = document.getElementById('editRasHewanForm');
        const inputNama = document.getElementById('edit_nama_ras');
        const selectJenis = document.getElementById('edit_idjenis_hewan');

        const updateRouteTemplate = "{{ route('admin.ras.update', ':id') }}";

   
        document.querySelectorAll('.btn-edit-ras').forEach(button => {
            button.addEventListener('click', function() {
             
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const idJenis = this.getAttribute('data-jenis');
     
                inputNama.value = nama;

                selectJenis.value = idJenis;

                form.action = updateRouteTemplate.replace(':id', id);
            });
        });
    });
</script>
@endpush