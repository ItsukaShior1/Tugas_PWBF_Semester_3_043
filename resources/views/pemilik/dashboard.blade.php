@php
// Memastikan variabel $user dan $role tersedia di view ini
use Illuminate\Support\Facades\Auth;

$user = Auth::user();

// Asumsi model User memiliki relasi atau method untuk mendapatkan role aktif
// dan model Role memiliki properti 'nama_role'
// Jika $user->activeRole() tidak ada, Anda perlu mengganti ini dengan cara yang benar
// untuk mendapatkan role aktif (misalnya, $user->roles()->where('status', 1)->first())
$role = $user->activeRole();

// Data untuk Small Box (Menu Navigasi Utama)
$cards = [
[
'title' => 'Data Hewan Saya',
'icon' => 'fas fa-paw',
'count' => 'Kelola Pet',
'bg_class' => 'bg-info',
// KOREKSI: Mengganti route yang salah menjadi 'pemilik.daftar_pet'
'route' => route('pemilik.daftar_pet'),
'description' => 'Lihat dan kelola informasi hewan peliharaan Anda.',
],
[
'title' => 'Janji Temu',
'icon' => 'fas fa-calendar-check',
'count' => 'Reservasi Baru',
'bg_class' => 'bg-warning',
// Pastikan nama route ini benar di routes/web.php
'route' => route('pemilik.daftar_reservasi'),
'description' => 'Atur dan cek status janji temu dengan dokter.',
],
[
'title' => 'Riwayat Medis',
'icon' => 'fas fa-history',
'count' => 'Cek Riwayat',
'bg_class' => 'bg-success',
// Pastikan nama route ini benar di routes/web.php
'route' => route('pemilik.daftar_rekam_medis'),
'description' => 'Lihat riwayat pemeriksaan dan pengobatan hewan Anda.',
],
];
@endphp

{{-- Asumsi Anda memiliki layout utama AdminLTE di 'layouts.lte.main' --}}
@extends('layouts.lte.main')

@section('title', 'Dashboard Pemilik')

@section('content_header')
<h1>
Dashboard Pemilik
<small>{{ $user->nama }}</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{ route('pemilik.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        {{-- Pesan Selamat Datang khas AdminLTE --}}
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fas fa-user-circle"></i> Selamat Datang!</h4>
            {{-- Gunakan pengecekan untuk $role jika activeRole() mungkin null --}}
            Halo <strong>{{ $user->nama }}</strong>, Anda login sebagai <strong>{{ $role->nama_role ?? 'Klien' }}</strong>. Selamat datang di portal layanan klien!
        </div>
    </div>
</div>

{{-- Small Boxes for Navigation (Komponen Utama Dashboard) --}}
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

{{-- Konten Tambahan: Aktivitas Terbaru (Placeholder) --}}
<div class="row">
    <div class="col-md-6">
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-clock"></i> Janji Temu Mendatang</h3>
            </div>
            <div class="box-body">
               
                <a href="{{ route('pemilik.daftar_reservasi') }}" class="btn btn-default btn-xs mt-3">Lihat Semua Janji Temu</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title"><i class="fas fa-history"></i> Riwayat Singkat</h3>
            </div>
            <div class="box-body">
                <
                <a href="{{ route('pemilik.daftar_rekam_medis') }}" class="btn btn-default btn-xs mt-3">Lihat Semua Riwayat Medis</a>
            </div>
        </div>
    </div>
</div>


@endsection