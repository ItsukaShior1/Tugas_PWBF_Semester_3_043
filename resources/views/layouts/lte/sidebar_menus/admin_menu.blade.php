@php
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

    $isDataMasterActive = false;
    foreach ($dataMasterMenus as $menu) {
        if (request()->routeIs($menu['route'])) {
            $isDataMasterActive = true;
            break;
        }
    }
    $dataMasterParentRoute = 'admin.data.master';
@endphp


<li class="nav-header">ADMINISTRATOR MENU</li>

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

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-bar-chart-fill"></i>
        <p>Laporan Penjualan</p>
    </a>
</li>