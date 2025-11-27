@extends('layouts.lte.main')

@section('title', 'Dashboard Resepsionis')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">👋 Selamat Datang, Resepsionis!</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $reservasiHariIni }}</h3>
                            <p>Reservasi Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-calendar-check-fill"></i>
                        </div>
                        <a href="{{ route('resepsionis.temu_dokter.index') }}" class="small-box-footer">
                            Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $reservasiMenunggu }}</h3>
                            <p>Menunggu Antrian</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <a href="{{ route('resepsionis.temu_dokter.index') }}?status=Menunggu" class="small-box-footer">
                            Kelola Antrian <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ App\Models\Pet::count() }}</h3>
                            <p>Total Pet Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-house-heart-fill"></i>
                        </div>
                        <a href="{{ route('resepsionis.pet.index') }}" class="small-box-footer">
                            Lihat Pet <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Reservasi Terbaru</h3>
                                <a href="{{ route('resepsionis.temu_dokter.index') }}">Lihat Semua</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                    <tr>
                                        <th>No. Urut</th>
                                        <th>Pet (Pemilik)</th>
                                        <th>Waktu Daftar</th>
                                        <th>Dokter Target</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservasiTerbaru as $temu)
                                        <tr>
                                            <td><span class="badge bg-primary">{{ $temu->no_urut }}</span></td>
                                            <td>
                                                {{ $temu->pet->nama_hewan }} 
                                                <small class="text-muted d-block">({{ $temu->pet->pemilik->user->nama ?? 'N/A' }})</small>
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d M H:i') }}</td>
                                            <td>{{ $temu->dokter->user->nama ?? 'Belum Ditunjuk' }}</td>
                                            <td><span class="badge bg-{{ $temu->status == 'Menunggu' ? 'warning' : 'success' }}">{{ $temu->status }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection