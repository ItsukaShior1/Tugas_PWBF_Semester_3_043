@extends('layouts.lte.main')

@section('title', 'Data Hewan Peliharaan')

@section('content')

<main class="app-main">
    <div class="app-content">
        <div class="container">
            
            {{-- Content Header --}}
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Hewan Peliharaan 🐕</h1> 
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end"> 
                                <li class="breadcrumb-item"><a href="{{ route('admin.data.master') }}">Master Data</a></li> 
                                <li class="breadcrumb-item active" aria-current="page">Pet</li> 
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
                            <h3 class="card-title">Tabel Data Hewan</h3>
                            <div class="card-tools">
                                 <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#createPetModal">
                                     <i class="bi bi-plus-lg"></i> Tambah Pet
                                 </button>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- Tabel --}}
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID</th> 
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Ras</th>
                                        <th>Pemilik</th>
                                        <th>Warna Tanda</th>
                                        <th style="width: 150px">Aksi</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pet as $pt) 
                                    <tr>
                                        <td>{{ $pt->idpet }}</td> 
                                        <td>{{ $pt->nama }}</td>
                                        <td>{{ $pt->jenis_kelamin }}</td>
                                        <td>{{ $pt->nama_ras }}</td>
                                        <td>{{ $pt->nama_pemilik }}</td>
                                        <td>{{ $pt->warna_tanda }}</td>
                                        <td>
                                        
                                            <button type="button" class="btn btn-sm btn-primary btn-edit-pet"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editPetModal"
                                                    data-id="{{ $pt->idpet }}"
                                                    data-nama="{{ $pt->nama }}"
                                                    data-jk="{{ $pt->jenis_kelamin }}"
                                                    data-ras-id="{{ $pt->idras_hewan }}"
                                                    data-pemilik-id="{{ $pt->idpemilik }}"
                                                    data-tgl-lahir="{{ $pt->tanggal_lahir }}"
                                                    data-warna-tanda="{{ $pt->warna_tanda ?? '' }}">
                                                Edit
                                            </button>
                                            
                                            <form action="{{ route('admin.pet.destroy', $pt->idpet) }}" 
                                                    method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                         onclick="return confirm('Anda yakin ingin menghapus data pet ini?')"> 
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data hewan peliharaan.</td>
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

<div class="modal fade" id="createPetModal" tabindex="-1" aria-labelledby="createPetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPetModalLabel">➕ Tambah Pet Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label for="create_nama" class="form-label">Nama Hewan:</label>
                        <input type="text" class="form-control" id="create_nama" name="nama" required>
                    </div>

                    <div class="mb-3">
                        <label for="create_tgl_lahir" class="form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="create_tgl_lahir" name="tanggal_lahir" required>
                    </div>

                    <div class="mb-3">
                        <label for="create_jk" class="form-label">Jenis Kelamin:</label>
                        <select class="form-select" id="create_jk" name="jenis_kelamin" required>
                            <option value="">-- Pilih --</option>
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="create_warna" class="form-label">Warna/Tanda:</label>
                        <input type="text" class="form-control" id="create_warna" name="warna_tanda">
                    </div>

                    <div class="mb-3">
                        <label for="create_ras" class="form-label">Ras Hewan:</label>
                        <select class="form-select" id="create_ras" name="idras_hewan" required>
                            <option value="">-- Pilih Ras --</option>
                            @foreach($ras as $r)
                                <option value="{{ $r->idras_hewan }}">
                                    {{ $r->nama_ras }} ({{ $r->nama_jenis_hewan }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="create_pemilik" class="form-label">Pemilik:</label>
                        <select class="form-select" id="create_pemilik" name="idpemilik" required>
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach($pemilik as $pm)
                                <option value="{{ $pm->idpemilik }}">{{ $pm->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan Pet</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editPetModal" tabindex="-1" aria-labelledby="editPetModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPetModalLabel">✏️ Edit Data Pet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editPetForm" method="POST" action=""> 
                @csrf
                @method('PUT') 
                <div class="modal-body">
                    
                    {{-- Nama --}}
                    <div class="mb-3">
                        <label for="edit_nama" class="form-label">Nama Hewan:</label>
                        <input type="text" class="form-control" id="edit_nama" name="nama" required>
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="mb-3">
                        <label for="edit_tanggal_lahir" class="form-label">Tanggal Lahir:</label>
                        <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="mb-3">
                        <label for="edit_jk" class="form-label">Jenis Kelamin:</label>
                        <select class="form-select" id="edit_jk" name="jenis_kelamin" required>
                            <option value="Jantan">Jantan</option>
                            <option value="Betina">Betina</option>
                        </select>
                    </div>

                    {{-- Warna/Tanda --}}
                    <div class="mb-3">
                        <label for="edit_warna" class="form-label">Warna/Tanda:</label>
                        <input type="text" class="form-control" id="edit_warna" name="warna_tanda">
                    </div>

                    {{-- Ras Hewan --}}
                    <div class="mb-3">
                        <label for="edit_ras" class="form-label">Ras Hewan:</label>
                        <select class="form-select" id="edit_ras" name="idras_hewan" required>
                             @foreach($ras as $r)
                                <option value="{{ $r->idras_hewan }}">
                                    {{ $r->nama_ras }} ({{ $r->nama_jenis_hewan }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Pemilik --}}
                    <div class="mb-3">
                        <label for="edit_pemilik" class="form-label">Pemilik:</label>
                        <select class="form-select" id="edit_pemilik" name="idpemilik" required>
                            @foreach($pemilik as $pm)
                                <option value="{{ $pm->idpemilik }}">{{ $pm->nama }}</option>
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
        
        const form = document.getElementById('editPetForm');

        const updateRouteTemplate = "{{ route('admin.pet.update', ':id') }}";

   
        document.querySelectorAll('.btn-edit-pet').forEach(button => {
            button.addEventListener('click', function() {
                // Ambil data dari atribut data-
                const id = this.getAttribute('data-id');
                const nama = this.getAttribute('data-nama');
                const jk = this.getAttribute('data-jk');
                const rasId = this.getAttribute('data-ras-id');
                const pemilikId = this.getAttribute('data-pemilik-id');
                const tglLahir = this.getAttribute('data-tgl-lahir');
                const warnaTanda = this.getAttribute('data-warna-tanda');

                // 1. Isi input pada modal
                document.getElementById('edit_nama').value = nama;
                document.getElementById('edit_tanggal_lahir').value = tglLahir;
                document.getElementById('edit_jk').value = jk; // Set nilai select (Jantan/Betina)
                document.getElementById('edit_ras').value = rasId; // Set nilai select Ras
                document.getElementById('edit_pemilik').value = pemilikId; // Set nilai select Pemilik
                document.getElementById('edit_warna').value = warnaTanda; // Set nilai warna/tanda
                

                // 2. Set action URL untuk form dengan ID yang sesuai
                form.action = updateRouteTemplate.replace(':id', id);
            });
        });
    });
</script>
@endpush