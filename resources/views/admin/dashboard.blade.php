@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $role = $user->activeRole();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard {{ $role ? $role->nama_role : '' }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin_page.css') }}">
</head>
<body>
    <div class="navbar">
        {{-- Link ke Dashboard sesuai role --}}
        @if($role)
            @php
                $roleRouteMap = [
                    'Administrator' => 'administrator.dashboard',
                    'Dokter'       => 'dokter.dashboard',
                    'Perawat'      => 'perawat.dashboard',
                    'Resepsionis'  => 'resepsionis.dashboard',
                    'Pemilik'      => 'pemilik.dashboard',
                ];
                $dashboardRoute = $roleRouteMap[$role->nama_role] ?? '#';
            @endphp
            <a href="{{ route($dashboardRoute) }}" style="font-weight: bold;">Dashboard</a>
        @endif

        {{-- Hanya Administrator yang punya akses ke Data Master --}}
        @if($role && $role->nama_role === 'Administrator')
            <a href="{{ route('admin.data.master') }}">Data Master</a>
        @endif

        {{-- Tombol Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-link">Logout</button>
        </form>
    </div>

    <div class="content">
        <h2>Hallo {{ $user->nama }}, Anda login sebagai {{ $role ? $role->nama_role : 'User' }}</h2>
        <p>Selamat datang di halaman {{ $role ? $role->nama_role : '' }}!</p>

        {{-- Kalau Administrator, tampilkan shortcut --}}
        @if($role && $role->nama_role === 'Administrator')
            <div style="margin-top: 30px;">
                <p>📦 Anda dapat mengelola Data Master di menu atas atau klik tombol di bawah ini:</p>
                <a href="{{ route('admin.data.master') }}"
                   style="display:inline-block; background:#d072d0; color:white; padding:10px 18px; border-radius:8px; text-decoration:none;">
                   ➜ Buka Data Master
                </a>
            </div>
        @endif
    </div>
</body>
</html>
