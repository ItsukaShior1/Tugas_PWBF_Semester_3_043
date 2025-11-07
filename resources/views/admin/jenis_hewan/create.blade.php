@extends('layouts.admin_layout')

@section('title', 'Tambah Jenis Hewan')

@section('content')
<div class="container">
    <h2>➕ Tambah Jenis Hewan Baru</h2>
    <p>Isi form di bawah untuk menambahkan jenis hewan baru.</p>

    {{-- Pesan Error Validasi --}}
    @if ($errors->any())
        <div style="background:#ffe6e6; border-left:4px solid red; padding:10px; margin-bottom:15px; color:#b30000;">
            <ul style="margin:0; padding-left:20px;">
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Pesan Sukses (kalau redirect dari store gagal/sukses) --}}
    @if(session('success'))
        <div style="background:#e7ffe7; border-left:4px solid #28a745; padding:10px; margin-bottom:15px; color:#1d6f32;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Form Input --}}
    <form action="{{ route('admin.jenis.store') }}" method="POST" style="margin-top:15px;">
        @csrf

        <label for="nama_jenis_hewan" style="font-weight:bold;">Nama Jenis Hewan:</label><br>
        <input 
            type="text" 
            name="nama_jenis_hewan" 
            id="nama_jenis_hewan" 
            value="{{ old('nama_jenis_hewan') }}" 
            required 
            style="padding:8px; width:50%; margin-top:5px; border-radius:5px; border:1px solid #ccc;"
        ><br><br>

        <button type="submit" 
            style="background:#d072d0; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer;">
            💾 Simpan
        </button>
        <a href="{{ route('admin.jenis.index') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           ← Batal
        </a>
    </form>
</div>
@endsection
