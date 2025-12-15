@extends('layouts.lte.main')

@section('title', 'Detail Rekam Medis')

@section('content_header')
<h1>
Detail Rekam Medis
<small>RM#{{ $rekamMedis->idrekam_medis }}</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('perawat.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
    <li><a href="{{ route('perawat.rekam-medis.index') }}">Rekam Medis</a></li>
    <li class="active">Detail</li>
</ol>
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-file-medical"></i> Informasi Rekam Medis</h3>
                <div class="box-tools">
                    <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-default btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>Data Pasien & Reservasi</h4>
                        <table class="table table-bordered table-sm">
                            <tr>
                                <th style="width: 30%">No. Urut Reservasi</th>
                                <td>{{ $rekamMedis->reservasi->no_urut ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Waktu Daftar</th>
                                <td>{{ $rekamMedis->reservasi->waktu_daftar ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pasien (Pet)</th>
                                <td>{{ $rekamMedis->reservasi->pet->nama_pet ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin Pet</th>
                                <td>{{ $rekamMedis->reservasi->pet->jenis_kelamin ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Pemilik</th>
                                <td>{{ $rekamMedis->reservasi->pet->pemilik->user->nama ?? '-' }}</td>
                            </tr>
                            <tr>
                                <th>Dokter Pemeriksa</th>
                                <td>{{ $rekamMedis->dokterPemeriksa->user->nama ?? 'N/A' }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h4>Data Klinis Dasar</h4>
                        <p><strong>Anamnesa:</strong></p>
                        <p class="well well-sm">{{ $rekamMedis->anamnesa }}</p>

                        <p><strong>Temuan Klinis:</strong></p>
                        <p class="well well-sm">{{ $rekamMedis->temuan_klinis }}</p>
                        
                        <p><strong>Diagnosa:</strong></p>
                        <p class="well well-sm">{{ $rekamMedis->diagnosa }}</p>
                        
                        <p><strong>Dicatat Tanggal:</strong> {{ $rekamMedis->created_at }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-notes-medical"></i> Tindakan & Terapi (Detail RM)</h3>
                <div class="box-tools">
                    <span class="text-sm text-warning"><i class="fas fa-exclamation-triangle"></i> Detail Tindakan hanya bisa ditambahkan oleh Dokter.</span>
                </div>
            </div>
            <div class="box-body">
                @if ($rekamMedis->details->isEmpty())
                    <div class="alert alert-warning">
                        Belum ada Tindakan atau Terapi yang dicatat oleh Dokter untuk Rekam Medis ini.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Kode Tindakan</th>
                                    <th>Kategori Klinis</th>
                                    <th>Deskripsi Tindakan/Terapi</th>
                                    <th>Detail / Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekamMedis->details as $detail)
                                    <tr>
                                        <td>{{ $detail->kodeTindakan->kode ?? 'N/A' }}</td>
                                        <td>{{ $detail->kategoriKlinis->nama_kategori_klinis ?? 'N/A' }}</td>
                                        <td>{{ $detail->deskripsi }}</td>
                                        <td>{{ $detail->detail }}</td>
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

@endsection