@extends('layouts.lte.main')

@section('title', 'Data Master')

@section('content')

<main class="app-main">
    <div class="app-content">
        <div class="container">

            {{-- HEADER --}}
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Master</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Master Data</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Data Master</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MENU --}}
            <div class="row">

                @php
                    $menus = [
                        ['route' => 'admin.user.index', 'icon' => '👥', 'label' => 'Data User'],
                        ['route' => 'admin.jenis.index', 'icon' => '🐾', 'label' => 'Jenis Hewan'],
                        ['route' => 'admin.ras.index', 'icon' => '🐶', 'label' => 'Ras Hewan'],
                        ['route' => 'admin.kategori.index', 'icon' => '📂', 'label' => 'Kategori'],
                        ['route' => 'admin.kategoriKlinis.index', 'icon' => '💉', 'label' => 'Kategori Klinis'],
                        ['route' => 'admin.kode.index', 'icon' => '🧾', 'label' => 'Kode Tindakan'],
                        ['route' => 'admin.pemilik.index', 'icon' => '👤', 'label' => 'Pemilik'],
                        ['route' => 'admin.pet.index', 'icon' => '🐕', 'label' => 'Pet'],
                        ['route' => 'admin.dokter.index', 'icon' => '🩺', 'label' => 'Data Dokter'],
                        ['route' => 'admin.perawat.index', 'icon' => '💉', 'label' => 'Data Perawat']
                    ];
                @endphp

                @foreach($menus as $menu)
                <div class="col-md-3 col-sm-6 mb-3">

                    <a href="{{ route($menu['route']) }}" class="text-decoration-none">
                        <div class="card shadow-sm h-100" style="transition: .2s;">
                            <div class="card-body text-center">
                                <div style="font-size: 40px;">{{ $menu['icon'] }}</div>
                                <div class="mt-2 fw-bold">{{ $menu['label'] }}</div>
                            </div>
                        </div>
                    </a>

                </div>
                @endforeach

            </div>

        </div>
    </div>
</main>

@endsection
