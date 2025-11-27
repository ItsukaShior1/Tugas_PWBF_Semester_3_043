@php
    use Illuminate\Support\Facades\Auth;
    $user = Auth::user();
    $role = $user ? $user->activeRole() : null;
    $roleName = optional($role)->nama_role; 

    $roleRouteMap = [
        'Administrator' => 'administrator.dashboard',
        'Dokter'        => 'dokter.dashboard',
        'Perawat'       => 'perawat.dashboard',
        'Resepsionis'   => 'resepsionis.dashboard',
        'Pemilik'       => 'pemilik.dashboard',
    ];
    $dashboardRouteName = $role ? ($roleRouteMap[$role->nama_role] ?? '#') : '#';


@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route($dashboardRouteName) }}" class="brand-link">
            <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="Logo App"
                class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">{{ config('app.name', 'My App') }}</span>
        </a>
    </div>
    @if ($user)
    <div class="sidebar-user block">
        <div class="nav-link bg-dark mx-2 mt-2 py-2 rounded">
            <div class="user-panel d-flex">
                <div class="image">
                    <img
                        src="https://placehold.co/160x160/2563EB/FFFFFF/svg?text={{ substr($user->name, 0, 1) }}"
                        class="img-circle elevation-2"
                        alt="User Image"
                    />
                </div>
                <div class="info d-flex flex-column align-items-start">
                    <p class="mb-0 text-truncate text-white" style="max-width: 150px;">{{ $user->name }}</p>
                    @if ($role)
                        <span class="badge text-bg-success text-xs">{{ $role->nama_role }}</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >
 
                <li class="nav-item">
                    <a href="{{ route($dashboardRouteName) }}" class="nav-link @if(request()->routeIs($dashboardRouteName)) active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

 
                @switch($roleName)
                    @case('Administrator')
                        @include('layouts.lte.sidebar_menus.admin_menu')
                        @break
                    @case('Dokter')
                        @include('layouts.lte.sidebar_menus.dokter_menu')
                        @break
                    @case('Perawat')
                        @include('layouts.lte.sidebar_menus.perawat_menu')
                        @break
                    @case('Resepsionis')
                        @include('layouts.lte.sidebar_menus.resepsionis_menu')
                        @break
                    @case('Pemilik')
                        @include('layouts.lte.sidebar_menus.pemilik_menu')
                        @break
                    @default
                        <li class="nav-header">MENU DEFAULT</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-info-circle-fill"></i>
                                <p>Info Aplikasi</p>
                            </a>
                        </li>
                @endswitch
                
                
                <li class="nav-header">AKUN</li>

                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-start w-100">
                            <i class="nav-icon bi bi-box-arrow-right text-danger"></i>
                            <p class="text-white">Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
    </aside>