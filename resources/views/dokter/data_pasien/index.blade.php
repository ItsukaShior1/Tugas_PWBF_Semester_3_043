@php
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator $pemilikList
     * @var \App\Models\Pemilik $pemilik
     * @var \App\Models\Pet $pet
     */
@endphp
@extends('layouts.lte.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Pasien Diperiksa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Pasien</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Daftar Pemilik & Hewan (Pasien Anda)</h3>
                        </div>
                        
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-valign-middle">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Pemilik</th>
                                            <th>Kontak (WA)</th>
                                            <th style="width: 40%;">Detail Pet (Pasien)</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pemilikList as $index => $pemilik)
                                            <tr>
                                                
                                                <td>{{ $pemilikList->firstItem() + $index }}</td>
                                                <td>
                                                    <i class="bi bi-person-badge-fill text-primary"></i>
                                                    {{ optional($pemilik->user)->nama ?? 'N/A' }}
                                                    <br>
                                                    <small class="text-muted">{{ optional($pemilik->user)->email }}</small>
                                                </td>
                                                <td>{{ $pemilik->no_wa }}</td>
                                                <td>
                                                    @forelse ($pemilik->pet as $pet)
                                                        <div class="d-flex align-items-center mb-1 border-bottom">
                                                            <i class="bi bi-paw-fill me-2 text-success"></i>
                                                            <div>
                                                                <strong class="text-dark">{{ $pet->nama_hewan }}</strong>
                                                                <small class="text-muted d-block">
                                                                    {{ optional($pet->jenis)->nama_jenis ?? 'Jenis N/A' }} / {{ optional($pet->ras)->nama_ras ?? 'Ras N/A' }} 
                                                                    | Berat: {{ $pet->berat }} kg
                                                                </small>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <span class="text-warning">Tidak ada Pet yang terhubung atau pernah Anda periksa.</span>
                                                    @endforelse
                                                </td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info" title="Lihat Profil Pemilik">
                                                        <i class="bi bi-eye"></i> Profil
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada data pasien (Pemilik/Pet) yang pernah Anda periksa.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection