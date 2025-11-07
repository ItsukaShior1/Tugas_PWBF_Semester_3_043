@extends('layouts.admin_layout')

@section('title', 'Tambah Kategori')

@section('content')
<div class="container">
    <h2>➕ Tambah Kategori Baru</h2>
    <p>Isi form di bawah untuk menambahkan kategori baru ke dalam sistem.</p>

    {{-- Notifikasi error validasi --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategori.store') }}" method="POST" style="margin-top:15px;">
        @csrf
        <label for="nama_kategori">Nama Kategori:</label><br>
        <input type="text" name="nama_kategori" id="nama_kategori"
               value="{{ old('nama_kategori') }}" 
               required
               style="padding:8px; width:60%; margin-top:5px; border-radius:5px; border:1px solid #ccc;"><br><br>

        <button type="submit" 
                style="background:#d072d0; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer;">
            Simpan
        </button>

        <a href="{{ route('admin.kategori.index') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           Batal
        </a>
    </form>
</div>
@endsection
