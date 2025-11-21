@extends('layouts.lte.main')

@section('content')
<div class="container">

    <h3 class="mb-4">Data Perawat</h3>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahPerawat">
        + Tambah Perawat
    </button>

   
    <div class="card">
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Perawat</th>
                        <th>Email</th>
                        <th>User ID</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($perawat as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama_perawat }}</td>
                        <td>{{ $p->user->email }}</td>
                        <td>{{ $p->iduser }}</td>

                        <td>
                            <!-- EDIT -->
                            <button class="btn btn-success btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#modalEditPerawat{{ $p->idperawat }}">
                                <i class="fa fa-edit"></i>
                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('admin.perawat.destroy', $p->idperawat) }}"
                                method="POST" class="d-inline"
                                onsubmit="return confirm('Yakin ingin menghapus perawat ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                   
                    <div class="modal fade" id="modalEditPerawat{{ $p->idperawat }}">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('admin.perawat.update', $p->idperawat) }}">
                                @csrf @method('PUT')
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5>Edit Perawat</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <label>Nama Perawat</label>
                                        <input type="text" name="nama_perawat" class="form-control"
                                            value="{{ $p->nama_perawat }}" required>

                                        <label class="mt-3">Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ $p->user->email }}" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button class="btn btn-primary">Simpan</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<div class="modal fade" id="modalTambahPerawat">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.perawat.store') }}">
            @csrf
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Tambah Perawat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <label>Nama Perawat</label>
                    <input type="text" name="nama_perawat" class="form-control" required>

                    <label class="mt-3">Email User</label>
                    <input type="email" name="email" class="form-control" required>

                    <label class="mt-3">Password User</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button class="btn btn-primary">Simpan</button>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
