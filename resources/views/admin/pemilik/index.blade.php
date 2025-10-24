@extends('layouts.admin_layout')

@section('title', 'Data Pemilik')

@section('content')
    <div class="container">
        <h2>👤 Data Pemilik</h2>
        <p>Daftar pemilik hewan terdaftar.</p>
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemilik</th>
                    <th>No. WhatsApp</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $pemilik)
                    <tr>
                        <td>{{ $pemilik->idpemilik }}</td>
                        <td>{{ $pemilik->user->nama ?? '-' }}</td>
                        <td>{{ $pemilik->no_wa ?? '-' }}</td>
                        <td>{{ $pemilik->alamat ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
