{{-- resources/views/dokter/rekam_medis/detail.blade.php --}}

@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis')
<?php
/**
 * @var \App\Models\RekamMedis $rekam 
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\KodeTindakan[] $kodeTindakanList
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\DetailRekamMedis[] $details
 */
?>

@section('content')

<div class="container-fluid">
    <h2 class="fw-bold mb-4">Detail Rekam Medis {{ $rekam->idrekam_medis }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    
    <div class="row">
        {{-- Kiri: Informasi Utama --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="card-title mb-0">Informasi Kunjungan</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>No Urut:</strong> {{ optional($rekam->reservasi)->no_urut ?? '-' }}</li>
                        <li class="list-group-item"><strong>Nama Pet:</strong> {{ optional($rekam->reservasi->pet)->nama_pet ?? '-' }}</li>
                        <li class="list-group-item"><strong>Nama Pemilik:</strong> {{ optional($rekam->reservasi->pet->pemilik->user)->nama ?? '-' }}</li>
                        <li class="list-group-item"><strong>Dokter Pemeriksa:</strong> {{ optional($rekam->dokterPemeriksa->user)->nama ?? '-' }}</li>
                        <li class="list-group-item"><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($rekam->created_at)->format('d-m-Y H:i') }}</li>
                    </ul>
                </div>
            </div>
            
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-info text-white">
                    <h4 class="card-title mb-0">Catatan Medis</h4>
                </div>
                <div class="card-body">
                    <strong>Anamnesa:</strong>
                    <p class="border p-2">{{ $rekam->anamnesa ?? '-' }}</p>
                    
                    <strong>Temuan Klinis:</strong>
                    <p class="border p-2">{{ $rekam->temuan_klinis ?? '-' }}</p>
                    
                    <strong>Diagnosa:</strong>
                    <p class="border p-2">{{ $rekam->diagnosa ?? '-' }}</p>
                </div>
            </div>
        </div>
        
        {{-- Kanan: Detail Tindakan --}}
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Detail Tindakan Terapi</h4>
                    <a href="{{ route('dokter.rekamMedis.detail.create', $rekam->idrekam_medis) }}" class="btn btn-sm btn-light">
                        <i class="fas fa-plus"></i> Tambah Detail
                    </a>
                </div>
                <div class="card-body">
                    @if ($details->isEmpty())
                        <p class="text-muted text-center"><em>Belum ada tindakan terapi yang dicatat.</em></p>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Deskripsi</th>
                                        <th>Kategori Klinis</th>
                                        <th>Detail Spesifik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($details as $d)
                                        <tr>
                                            {{-- Perbaikan di sini: Menggunakan $d->kodeTindakanTerapi->kode, bukan $d->kodeTindakanTerapi->kode_tindakan --}}
                                            <td>{{ optional($d->kodeTindakanTerapi)->kode ?? '-' }}</td>
                                            <td>{{ optional($d->kodeTindakanTerapi)->deskripsi_tindakan_terapi ?? '-' }}</td>
                                            <td>{{ optional($d->kodeTindakanTerapi->kategoriKlinis)->nama_kategori_klinis ?? '-' }}</td>
                                            <td>{{ $d->detail ?? '-' }}</td>
                                            <td>
                                                <form action="{{ route('dokter.rekamMedis.detail.destroy', ['idrekam_medis' => $rekam->idrekam_medis, 'detailRekamMedi' => $d->iddetail_rekam_medis]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus detail ini?')" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('dokter.rekamMedis.index') }}" class="btn btn-secondary">← Kembali ke Daftar Rekam Medis</a>
    </div>

</div>

@endsection