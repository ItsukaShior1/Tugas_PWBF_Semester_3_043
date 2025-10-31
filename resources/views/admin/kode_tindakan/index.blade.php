@extends('layouts.admin_layout')

@section('title', 'Data Kode Tindakan Terapi')

@section('content')
    <div class="container">
        <h2>🧾 Data Kode Tindakan Terapi</h2>
        <p>Daftar tindakan dan terapi yang tersedia.</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kategori Klinis</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kodeTindakan as $kode)
                    <tr>
                        <td>{{ $kode->idkode_tindakan_terapi }}</td>
                        <td>{{ $kode->kode }}</td>
                        <td>{{ $kode->deskripsi_tindakan_terapi }}</td>
                        <td>{{ $kode->kategori->nama_kategori ?? '-' }}</td>
                        <td>{{ $kode->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
