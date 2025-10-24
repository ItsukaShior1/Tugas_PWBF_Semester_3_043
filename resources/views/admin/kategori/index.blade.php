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
                @foreach($data as $kategori)
                    <tr>
                        <td>{{ $kategori->idkategori }}</td>
                        <td>{{ $kategori->nama_kategori }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
