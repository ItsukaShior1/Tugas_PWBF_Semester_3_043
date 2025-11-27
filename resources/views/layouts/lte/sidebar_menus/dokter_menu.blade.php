
<li class="nav-header">DOKTER MENU</li>

<li class="nav-item">
    <a href="{{ route('dokter.rekamMedis.index') }}" class="nav-link @if(request()->routeIs('dokter.rekamMedis.*')) active @endif">
        <i class="nav-icon bi bi-file-earmark-medical-fill"></i>
        <p>Rekam Medis Saya</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('dokter.dataPasien.index') }}" class="nav-link @if(request()->routeIs('dokter.dataPasien.*')) active @endif">
        <i class="nav-icon bi bi-clipboard-pulse"></i>
        <p>Data Pasien</p>
    </a>
</li>
