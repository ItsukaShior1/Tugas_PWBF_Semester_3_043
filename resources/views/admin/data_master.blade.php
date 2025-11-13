@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $role = $user->activeRole();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Master - {{ $role ? $role->nama_role : '' }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin_page.css') }}">
    <style>
    
        .container {
            max-width: 900px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        .menu-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 15px;
        }
        .menu-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            border: 1px solid #ddd;
            transition: all 0.2s ease;
        }
        .menu-card:hover {
            background: #d072d0;
            color: white;
            transform: translateY(-2px);
        }
        .menu-card a {
            text-decoration: none;
            font-weight: bold;
            color: inherit;
        }
        .logout-form {
            float: right;
            margin: 0;
        }
        .logout-link {
            background: none;
            border: none;
            color: white;
            padding: 14px 20px;
            cursor: pointer;
            font-size: 1em;
        }
        .logout-link:hover {
            background: #7ed685;
        }
    </style>
</head>
<body>
    <div class="navbar">
      
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
            <a href="{{ route($dashboardRoute) }}">Dashboard</a>
        @endif

        <a href="{{ route('admin.data.master') }}" style="font-weight: bold; color: #7ed685;">Data Master</a>

        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-link">Logout</button>
        </form>
    </div>

    <div class="container">
        <h2>📚 Data Master</h2>
        <p style="text-align:center;">Pilih data master yang ingin dikelola:</p>

        <div class="menu-list">
            <div class="menu-card"><a href="{{ route('admin.user.index') }}">👥 Data User</a></div>
            <div class="menu-card"><a href="{{ route('admin.jenis.index') }}">🐾 Jenis Hewan</a></div>
            <div class="menu-card"><a href="{{ route('admin.ras.index') }}">🐶 Ras Hewan</a></div>
            <div class="menu-card"><a href="{{ route('admin.kategori.index') }}">📂 Kategori</a></div>
            <div class="menu-card"><a href="{{ route('admin.kategoriKlinis.index') }}">💉 Kategori Klinis</a></div>
            <div class="menu-card"><a href="{{ route('admin.kode.index') }}">🧾 Kode Tindakan</a></div>
            <div class="menu-card"><a href="{{ route('admin.pemilik.index') }}">👤 Pemilik</a></div>
            <div class="menu-card"><a href="{{ route('admin.pet.index') }}">🐕 Pet</a></div>
        </div>
    </div>
</body>
</html>
