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
                @foreach($pemilik as $p)
                    <tr>
                        <td>{{ $p->idpemilik }}</td>
                        <td>{{ $p->user->nama ?? '-' }}</td>
                        <td>{{ $p->no_wa ?? '-' }}</td>
                        <td>{{ $p->alamat ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
