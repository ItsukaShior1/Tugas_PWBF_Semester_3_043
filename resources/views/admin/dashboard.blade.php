@php
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Dokter;

// Ambil data user dan role
$user = Auth::user();
$role = $user->activeRole();

// Default data dashboard
$totalUsers = 0;
$totalDokters = 0;


if ($role && $role->nama_role === 'Administrator') {
    try {
        $totalUsers = User::count() ?? 0;
        $totalDokters = Dokter::count() ?? 0;

    } catch (\Exception $e) {
        $totalUsers = 'N/A';
        $totalDokters = 'N/A';

    }
}
@endphp

@extends('layouts.lte.main')

@section('title', 'Dashboard ' . ($role ? $role->nama_role : 'User'))

@section('content')

<div class="container-fluid">

    <h2 class="fw-bold mb-3">
        Halo {{ $user->nama }}, Anda login sebagai {{ $role->nama_role }}
    </h2>

    <p class="text-muted mb-4">Selamat datang di halaman dashboard {{ $role->nama_role }}!</p>

    @if($role && $role->nama_role === 'Administrator')

    <div class="row">

        <!-- Total Pengguna -->
        <div class="col-md-4">
            <div class="card text-bg-primary">
                <div class="card-body">
                    <h3>{{ $totalUsers }}</h3>
                    <p>Total Pengguna</p>
                </div>
            </div>
        </div>

        <!-- Total Dokter -->
        <div class="col-md-4">
            <div class="card text-bg-success">
                <div class="card-body">
                    <h3>{{ $totalDokters }}</h3>
                    <p>Total Dokter</p>
                </div>
            </div>
        </div>

      

    </div>

    <div class="mt-4">
        <a href="{{ route('admin.data.master') }}" class="btn btn-primary">
            Kelola Data Master
        </a>
    </div>

    @endif

</div>

@endsection
