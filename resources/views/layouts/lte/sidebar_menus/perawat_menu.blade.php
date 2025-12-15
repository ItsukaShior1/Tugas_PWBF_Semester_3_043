
<li class="nav-header">PERAWAT MENU</li>

<li class="nav-item">
    <a href="{{ route('perawat.rekam-medis.index') }}" class="nav-link @if(request()->routeIs('perawat.rekamMedis.*')) active @endif">
        <i class="nav-icon bi bi-file-earmark-medical-fill"></i>
        <p>Rekam Medis</p>
    </a>
</li>
