@php
    use Illuminate\Support\Facades\Auth;
    // Ambil data user dan role
    $user = Auth::user();
    $role = $user ? $user->activeRole() : null;

    // Map role ke route dashboard
    $roleRouteMap = [
        'Administrator' => 'administrator.dashboard',
        'Dokter'        => 'dokter.dashboard',
        'Perawat'       => 'perawat.dashboard',
        'Resepsionis'   => 'resepsionis.dashboard',
        'Pemilik'       => 'pemilik.dashboard',
    ];
    $dashboardRouteName = $role ? ($roleRouteMap[$role->nama_role] ?? '#') : '#';

    // Definisikan menu Data Master
    $dataMasterMenus = [
        ['name' => 'Data User', 'route' => 'admin.user.index', 'icon' => 'bi-people-fill'],
        ['name' => 'Jenis Hewan', 'route' => 'admin.jenis.index', 'icon' => 'bi-paw-fill'],
        ['name' => 'Ras Hewan', 'route' => 'admin.ras.index', 'icon' => 'bi-dog-fill'],
        ['name' => 'Kategori', 'route' => 'admin.kategori.index', 'icon' => 'bi-folder-fill'],
        ['name' => 'Kategori Klinis', 'route' => 'admin.kategoriKlinis.index', 'icon' => 'bi-clipboard-pulse'],
        ['name' => 'Kode Tindakan', 'route' => 'admin.kode.index', 'icon' => 'bi-journal-medical'],
        ['name' => 'Pemilik', 'route' => 'admin.pemilik.index', 'icon' => 'bi-person-badge-fill'],
        ['name' => 'Pet', 'route' => 'admin.pet.index', 'icon' => 'bi-house-heart-fill'],
    ];

    // Cek apakah salah satu submenu Data Master aktif untuk membuka treeview
    $isDataMasterActive = false;
    foreach ($dataMasterMenus as $menu) {
        if (request()->routeIs($menu['route'])) {
            $isDataMasterActive = true;
            break;
        }
    }
    $dataMasterParentRoute = 'admin.data.master'; // Route parent Data Master
@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <a href="{{ route($dashboardRouteName) }}" class="brand-link">
            <!-- Asumsi logo AdminLTE masih relevan. Ganti jika perlu -->
            <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="Logo App"
                class="brand-image opacity-75 shadow"
            />
            <span class="brand-text fw-light">{{ config('app.name', 'My App') }}</span>
        </a>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::User Panel-->
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
    <!--end::User Panel-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >
                {{-- 1. DASHBOARD --}}
                <li class="nav-item">
                    <a href="{{ route($dashboardRouteName) }}" class="nav-link @if(request()->routeIs($dashboardRouteName)) active @endif">
                        <i class="nav-icon bi bi-speedometer"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- 2. DATA MASTER (Dropdown Menu) --}}
                <li class="nav-item @if($isDataMasterActive) menu-open @endif">
                    <a href="{{ route($dataMasterParentRoute) }}" class="nav-link @if(request()->routeIs($dataMasterParentRoute) || $isDataMasterActive) active @endif">
                        <i class="nav-icon bi bi-database-fill"></i>
                        <p>
                            Data Master
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @foreach ($dataMasterMenus as $menu)
                        <li class="nav-item">
                            <a href="{{ route($menu['route']) }}" class="nav-link @if(request()->routeIs($menu['route'])) active @endif">
                                <i class="nav-icon bi {{ $menu['icon'] }}"></i>
                                <p>{{ $menu['name'] }}</p>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>

                {{-- Separator --}}
                <li class="nav-header">AKUN</li>

                {{-- 3. LOGOUT --}}
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
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>