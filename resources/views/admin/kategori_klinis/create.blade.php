@extends('layouts.admin_layout')

@section('title', 'Tambah Kategori Klinis')

@section('content')
<div class="container">
    <h2>➕ Tambah Kategori Klinis Baru</h2>
    <p>Isi form di bawah untuk menambahkan kategori klinis baru ke dalam sistem.</p>

    @if ($errors->any())
        <div style="color: red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategoriKlinis.store') }}" method="POST" style="margin-top:15px;">
        @csrf
        <label for="nama_kategori_klinis">Nama Kategori Klinis:</label><br>
        <input type="text" name="nama_kategori_klinis" id="nama_kategori_klinis"
               value="{{ old('nama_kategori_klinis') }}" 
               required style="padding:8px; width:50%; margin-top:5px; border-radius:5px; border:1px solid #ccc;"><br><br>

        <button type="submit" style="background:#d072d0; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer;">
            Simpan
        </button>
        <a href="{{ route('admin.kategoriKlinis.index') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           Batal
        </a>
    </form>
</div>
@endsection
