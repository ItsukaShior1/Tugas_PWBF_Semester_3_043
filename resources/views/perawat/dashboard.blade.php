@php
use Illuminate\Support\Facades\Auth;

$user = Auth::user();
$role = $user->activeRole(); 

$cards = [
    [
        'title' => 'Reservasi Hari Ini',
        'icon' => 'fas fa-calendar-alt',
        'count' => $reservasiHariIni . ' Pasien',
        'bg_class' => 'bg-info',
        'route' => route('perawat.rekam-medis.index'), 
        'description' => 'Pasien temu dokter yang terdaftar hari ini.',
    ],
    [
        'title' => 'Reservasi Diproses',
        'icon' => 'fas fa-clock',
        'count' => $reservasiProses . ' Pasien',
        'bg_class' => 'bg-warning',
        'route' => route('perawat.rekam-medis.index'), 
        'description' => 'Reservasi yang sedang dalam penanganan.',
    ],
    [
        'title' => 'Total Rekam Medis',
        'icon' => 'fas fa-file-medical',
        'count' => $totalRekamMedis . ' Data',
        'bg_class' => 'bg-success',
        'route' => route('perawat.rekam-medis.index'),
        'description' => 'Jumlah total rekam medis yang telah tercatat.',
    ],
    [
        'title' => 'Kelola Rekam Medis',
        'icon' => 'fas fa-pen-square',
        'count' => 'Lihat Data',
        'bg_class' => 'bg-primary',
        'route' => route('perawat.rekam-medis.index'),
        'description' => 'Akses penuh ke daftar dan CRUD Rekam Medis.',
    ],
];
@endphp

@extends('layouts.lte.main')

@section('title', 'Dashboard Perawat')

@section('content_header')
<h1>
Dashboard Perawat
<small>{{ $user->nama }}</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{ route('perawat.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fas fa-user-circle"></i> Selamat Datang!</h4>
            Halo <strong>{{ $user->nama }}</strong>, Anda login sebagai <strong>{{ $role->nama_role ?? 'Perawat' }}</strong>. Selamat bertugas mencatat data klinis pasien!
        </div>
    </div>
</div>

<div class="row">
    @foreach ($cards as $card)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box {{ $card['bg_class'] }}">
                <div class="inner">
                    <h3>{{ $card['count'] }}</h3> 
                    <p>{{ $card['title'] }}</p>
                </div>
                <div class="icon">
                    <i class="{{ $card['icon'] }}"></i>
                </div>
                <a href="{{ $card['route'] }}" class="small-box-footer">
                    Akses {{ $card['title'] }} <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    @endforeach
</div>
{{-- End Small Boxes --}}

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-info-circle"></i> Catatan Cepat</h3>
            </div>
            <div class="box-body">
                <p><strong>Reservasi Dokter yang Belum Memiliki RM:</strong> Terdapat <strong>{{ $reservasiSelesaiTanpaRM }}</strong> Temu Dokter yang berstatus Selesai, namun Rekam Medisnya belum tercatat. Pastikan semua transaksi klinis terekam dengan baik.</p>
                <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-default btn-sm mt-2">Periksa Rekam Medis</a>
            </div>
        </div>
    </div>
</div>

@endsection