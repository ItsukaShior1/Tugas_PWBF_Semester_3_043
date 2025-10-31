@extends('layouts.admin_layout')

@section('title', 'Data Ras Hewan')

@section('content')
    <div class="container">
        <h2>🐶 Data Ras Hewan</h2>
        <p>Daftar ras berdasarkan jenis hewan.</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Ras</th>
                    <th>Jenis Hewan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rasHewan as $ras)
                    <tr>
                        <td>{{ $ras->idras_hewan }}</td>
                        <td>{{ $ras->nama_ras }}</td>
                        <td>{{ $ras->jenis->nama_jenis_hewan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
