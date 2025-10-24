@extends('layouts.admin_layout')

@section('title', 'Data Jenis Hewan')

@section('content')
    <div class="container">
        <h2>🐾 Data Jenis Hewan</h2>
        <p>Daftar semua jenis hewan yang tersedia di sistem.</p>

        <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
            <thead>
                <tr style="background-color:#d072d0; color:white; text-align:left;">
                    <th style="padding:8px;">ID</th>
                    <th style="padding:8px;">Nama Jenis Hewan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisHewan as $jenis)
                    <tr style="border-bottom:1px solid #ddd;">
                        <td style="padding:8px;">{{ $jenis->idjenis_hewan }}</td>
                        <td style="padding:8px;">{{ $jenis->nama_jenis_hewan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" style="text-align:center; padding:12px; color:#999;">
                            Belum ada data jenis hewan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div style="margin-top:20px;">
            <a href="{{ route('admin.data.master') }}" 
               style="background:#7ed685; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
               ← Kembali ke Data Master
            </a>
        </div>
    </div>
@endsection
