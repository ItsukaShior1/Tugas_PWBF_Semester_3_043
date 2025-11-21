@extends('layouts.lte.main')

@section('title', 'Data Dokter')

@section('content')
<div class="container-fluid px-3">

    <!-- Judul & Tombol -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Data Dokter</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateDokter">
            <i class="fa fa-plus"></i> Tambah Dokter
        </button>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Card -->
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>List Dokter</strong>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>No HP</th>
                        <th>Bidang</th>
                        <th>JK</th>
                        <th>Alamat</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dokter as $i => $d)
                    <tr>
                        <td>{{ $i + 1 }}</td>
                        <td>{{ $d->user->nama }}</td>
                        <td>{{ $d->user->email }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>{{ $d->bidang_dokter }}</td>
                        <td>{{ $d->jenis_kelamin }}</td>
                        <td>{{ $d->alamat }}</td>
                        <td>
                            <!-- EDIT -->
                            <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditDokter{{ $d->iddokter }}">
                                <i class="fa fa-edit">Edit</i>
                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.dokter.destroy', $d->iddokter) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus dokter ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash">Delete</i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalEditDokter{{ $d->iddokter }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">

                                <form action="{{ route('admin.dokter.update', $d->iddokter) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Dokter</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body row g-3">

                                        <div class="col-md-6">
                                            <label>Nama</label>
                                            <input type="text" name="nama" value="{{ $d->user->nama }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="email" name="email" value="{{ $d->user->email }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>No HP</label>
                                            <input type="text" name="no_hp" value="{{ $d->no_hp }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Bidang Dokter</label>
                                            <input type="text" name="bidang_dokter" value="{{ $d->bidang_dokter }}" class="form-control" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Jenis Kelamin</label>
                                            <select name="jenis_kelamin" class="form-control" required>
                                                <option value="L" {{ $d->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                                <option value="P" {{ $d->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" value="{{ $d->alamat }}" class="form-control" required>
                                        </div>

                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center">Belum ada data dokter.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="modalCreateDokter" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form action="{{ route('admin.dokter.store') }}" method="POST">
                @csrf

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Dokter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body row g-3">

                    <div class="col-md-6">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>No HP</label>
                        <input type="text" name="no_hp" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Bidang Dokter</label>
                        <input type="text" name="bidang_dokter" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" required>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Alamat</label>
                        <input type="text" name="alamat" class="form-control" required>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Dokter</button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
