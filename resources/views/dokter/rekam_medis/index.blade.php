@extends('layouts.lte.main')

@section('title', 'Daftar Rekam Medis')
<?php
/**
 * @var \Illuminate\Pagination\LengthAwarePaginator|\App\Models\RekamMedis[] $rekamList
 */
?>

@section('content')

<div class="container-fluid">
    <h2 class="fw-bold mb-4">Daftar Rekam Medis Saya</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Rekam</th>
                        <th>No Urut</th>
                        <th>Nama Pet</th>
                        <th>Nama Pemilik</th>
                        <th>Diagnosa</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekamList as $rm)
                        <tr>
                            <td>{{ $rm->idrekam_medis }}</td>
                            <td>{{ optional($rm->reservasi)->no_urut ?? '-' }}</td>
                            <td>{{ optional($rm->reservasi->pet)->nama_pet ?? '-' }}</td>
                            <td>{{ optional($rm->reservasi->pet->pemilik->user)->nama ?? '-' }}</td>
                            <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                            <td>{{ \Carbon\Carbon::parse($rm->created_at)->format('d-m-Y') }}</td>
                            <td>
                                <a href="{{ route('dokter.rekamMedis.show', $rm->idrekam_medis) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Belum ada data rekam medis yang ditangani.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            <div class="d-flex justify-content-center">
                {{ $rekamList->links() }}
            </div>
        </div>
    </div>
</div>

@endsection