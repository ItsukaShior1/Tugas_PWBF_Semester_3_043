@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $role = $user->activeRole();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Page')</title>
    <link rel="stylesheet" href="{{ asset('css/admin_page.css') }}">
    <style>
        .container { margin: 40px auto; max-width: 900px; }
        table.data-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table.data-table th, table.data-table td {
            border: 1px solid #ccc; padding: 8px 12px; text-align: left;
        }
        table.data-table th { background: #f3f3f3; }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="{{ route('administrator.dashboard') }}">Dashboard</a>
        <a href="{{ route('admin.data.master') }}">Data Master</a>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-link">Logout</button>
        </form>
    </div>

    <main>
        @yield('content')
    </main>
</body>
</html>
