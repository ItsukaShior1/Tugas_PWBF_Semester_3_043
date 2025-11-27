@php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$role = $user->activeRole();
@endphp

@extends('layouts.lte.main')

@section('title', 'Dashboard Dokter')

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-3">
        Halo dr. {{ $user->nama }}, Anda login sebagai {{ $role->nama_role }}
    </h2>

    <p class="text-muted mb-4">Selamat datang di halaman dashboard Dokter!</p>

    <div class="row">

        <div class="col-md-4">
            <a href="{{ route('dokter.rekamMedis.index') }}" class="text-decoration-none">
                <div class="card text-bg-info shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold">📋 Rekam Medis</h3>
                        <p>Kelola dan lihat rekam medis pasien.</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('dokter.dataPasien.index') }}" class="text-decoration-none">
                <div class="card text-bg-success shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold">🐾 Data Pasien</h3>
                        <p>Lihat data pemilik dan hewan yang ditangani.</p>
                    </div>
                </div>
            </a>
        </div>

    </div>

</div>

@endsection
