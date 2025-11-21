@extends('layouts.lte.main')

@section('title', 'Dashboard Administrator')

@section('content')

{{-- Import model yang diasumsikan untuk hitungan --}}
@php
    // Catatan: Menggunakan FQCN agar tidak perlu "use" statement di Blade.
    // Pastikan model-model ini (User, Pemilik, Pet) tersedia di namespace App\Models.
    use App\Models\User;
    use App\Models\JenisHewan;
    use App\Models\Pemilik;
    use App\Models\Pet;

    $totalUsers = User::count() ?? 0;
    $totalJenisHewan = JenisHewan::count() ?? 0;
    $totalPemilik = Pemilik::count() ?? 0;
    $totalPet = Pet::count() ?? 0;
@endphp

<div class="container-fluid">
    
    {{-- Content Header (Page header) --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard Administrator 🩺</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    {{-- Main content --}}
    <section class="content">
        <div class="container-fluid">
            
            {{-- Row for Info Boxes (Small Boxes) --}}
            <div class="row">
                
                {{-- Box 1: Total User --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalUsers }}</h3>
                            <p>Total Pengguna Sistem</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <a href="{{ route('admin.user.index') }}" class="small-box-footer">
                            Lihat Detail <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                {{-- Box 2: Jenis Hewan --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalJenisHewan }}</h3>
                            <p>Total Jenis Hewan</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <a href="{{ route('admin.jenis.index') }}" class="small-box-footer">
                            Kelola Jenis Hewan <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                {{-- Box 3: Total Pemilik --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning text-white">
                        <div class="inner">
                            <h3>{{ $totalPemilik }}</h3>
                            <p>Total Pemilik Terdaftar</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-person-badge-fill"></i>
                        </div>
                        <a href="{{ route('admin.pemilik.index') }}" class="small-box-footer text-white">
                            Kelola Pemilik <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

                {{-- Box 4: Total Pet --}}
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalPet }}</h3>
                            <p>Total Hewan (Pet)</p>
                        </div>
                        <div class="icon">
                            <i class="bi bi-hospital"></i>
                        </div>
                        <a href="{{ route('admin.pet.index') }}" class="small-box-footer">
                            Data Hewan <i class="bi bi-arrow-right-circle"></i>
                        </a>
                    </div>
                </div>

            </div>
            {{-- /.row --}}

            {{-- Default Content Area (Welcome Card) --}}
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Status Sistem</h3>
                        </div>
                        <div class="card-body">
                            <p class="lead">
                                Selamat datang kembali, Administrator <b>{{ Auth::user()->name ?? 'System Admin' }}</b>!
                            </p>
                            <p>
                                Anda dapat memulai pengelolaan sistem melalui menu **Data Master** di navigasi samping.
                            </p>
                            <p class="text-muted"><small>Hak Akses: {{ strtoupper(Auth::user()->role ?? 'ADMIN') }}</small></p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- /.row --}}

        </div>
        {{-- /.container-fluid --}}
    </section>
    {{-- /.content --}}

</div>

@endsection

@push('scripts')
{{-- Tambahkan script khusus dashboard di sini jika diperlukan --}}
@endpush