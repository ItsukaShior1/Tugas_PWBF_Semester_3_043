@extends('layouts.admin_layout')

@section('title', 'Data Kategori')

@section('content')
    <div class="container">
        <h2>📂 Data Kategori</h2>
        <p>Daftar kategori tindakan atau pemeriksaan.</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Kategori</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $k)
                    <tr>
                        <td>{{ $k->idkategori }}</td>
                        <td>{{ $k->nama_kategori }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
