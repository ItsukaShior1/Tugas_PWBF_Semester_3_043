
<li class="nav-header">RESEPSIONIS MENU</li>

<li class="nav-item">
    <a href="{{ route('resepsionis.pemilik.create') }}" class="nav-link @if(request()->routeIs('resepsionis.pemilik.*')) active @endif" class="nav-link">
        <i class="nav-icon bi bi-calendar-plus-fill"></i>
        <p>Reservasi Pemilik</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('resepsionis.pet.create') }}" class="nav-link @if(request()->routeIs('resepsionis.pet.*')) active @endif" class="nav-link">
        <i class="nav-icon bi bi-calendar-plus-fill"></i>
        <p>Reservasi Pet</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('resepsionis.temu_dokter.index') }}" class="nav-link @if(request()->routeIs('resepsionis.temu_dokter.*')) active @endif" class="nav-link">
        <i class="nav-icon bi bi-cash-coin"></i>
        <p>Temu Dokter</p>
    </a>
</li>