@extends('layouts.admin_layout')

@section('title', 'Data Kategori Klinis')

@section('content')
    <div class="container">
        <h2>💉 Data Kategori Klinis</h2>
        <p>Daftar kategori pemeriksaan klinis.</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori Klinis</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategoriKlinis as $kategori)
                    <tr>
                        <td>{{ $kategori->idkategori_klinis }}</td>
                        <td>{{ $kategori->nama_kategori_klinis }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
