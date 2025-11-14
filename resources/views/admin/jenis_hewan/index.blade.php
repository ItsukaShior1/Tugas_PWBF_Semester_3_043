@extends('layouts.lte.main') 

@section('title', 'Data Jenis Hewan') 

@section('content') 

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Jenis Hewan</h1> 
                        </div><div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                                <li class="breadcrumb-item"><a href="#">Master Data</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">Jenis Hewan</li> 
                            </ol>
                        </div></div></div></div>
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
                            <h3 class="card-title">Tabel Data Jenis Hewan</h3>
                            <div class="card-tools">
                                 <a href="{{ route('admin.jenis.create') }}" class="btn btn-sm btn-success">
                                     <i class="bi bi-plus-lg"></i> Tambah Jenis Hewan
                                 </a>
                            </div>
                        </div>
                        <div class="card-body">
     
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
       
                                        <th>#</th> 
                                        <th>Nama Jenis Hewan</th>
                          
                                        <th style="width: 120px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($jenisHewan as $index => $jenis) 
                                    <tr>
                                        <td>{{ $index + 1 }}</td> 
                                        <td>{{ $jenis->nama_jenis_hewan }}</td>
                                        <td>
                                          
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-jenis"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editJenisHewanModal"
                                                    data-id="{{ $jenis->idjenis_hewan }}"
                                                    data-nama="{{ $jenis->nama_jenis_hewan }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.jenis.destroy', $jenis->idjenis_hewan) }}" 
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
                                        <td colspan="3" class="text-center">Belum ada data jenis hewan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer clearfix">
 
                        </div>
                    </div>
                    </div>
            </div>
            </div></div>
</main>


<div class="modal fade" id="editJenisHewanModal" tabindex="-1" aria-labelledby="editJenisHewanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJenisHewanModalLabel">Edit Jenis Hewan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
    
            <form id="editJenisHewanForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nama_jenis_hewan" class="form-label">Nama Jenis Hewan</label>
       
                        <input type="text" class="form-control" id="edit_nama_jenis_hewan" name="nama_jenis_hewan" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

        const form = document.getElementById('editJenisHewanForm');
        const inputNama = document.getElementById('edit_nama_jenis_hewan');

        const updateRouteTemplate = "{{ route('admin.jenis.update', ':id') }}";

        document.querySelectorAll('.btn-edit-jenis').forEach(button => {
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