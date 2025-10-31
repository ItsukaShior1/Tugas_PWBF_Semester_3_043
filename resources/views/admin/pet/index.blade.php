@extends('layouts.admin_layout')

@section('title', 'Data Hewan Peliharaan')

@section('content')
    <div class="container">
        <h2>🐕 Data Hewan Peliharaan</h2>
        <p>Daftar hewan milik para pemilik.</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Hewan</th>
                    <th>Jenis Kelamin</th>
                    <th>Ras</th>
                    <th>Pemilik</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pet as $pt)
                    <tr>
                        <td>{{ $pt->idpet }}</td>
                        <td>{{ $pt->nama }}</td>
                        <td>{{ $pt->jenis_kelamin }}</td>
                        <td>{{ $pt->ras->nama_ras ?? '-' }}</td>
                        <td>{{ $pt->pemilik->user->nama ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
