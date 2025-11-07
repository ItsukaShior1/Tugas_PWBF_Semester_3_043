@extends('layouts.admin_layout')

@section('title', 'Tambah Kode Tindakan')

@section('content')
<div class="container">
    <h2>➕ Tambah Kode Tindakan</h2>
    <p>Isi form di bawah untuk menambahkan kode tindakan atau terapi baru.</p>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kode.store') }}" method="POST" style="margin-top:15px;">
        @csrf

        <label for="kode">Kode:</label><br>
        <input type="text" name="kode" id="kode" value="{{ old('kode') }}" required
               style="padding:8px; width:50%; border:1px solid #ccc; border-radius:5px;"><br><br>

        <label for="deskripsi_tindakan_terapi">Deskripsi:</label><br>
        <input type="text" name="deskripsi_tindakan_terapi" id="deskripsi_tindakan_terapi"
               value="{{ old('deskripsi_tindakan_terapi') }}" required
               style="padding:8px; width:50%; border:1px solid #ccc; border-radius:5px;"><br><br>

        <label for="idkategori">Kategori:</label><br>
        <select name="idkategori" id="idkategori" style="padding:8px; width:50%; border-radius:5px;">
            <option value="">-- Pilih Kategori --</option>
            @foreach($kategori as $k)
                <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
            @endforeach
        </select><br><br>

        <label for="idkategori_klinis">Kategori Klinis:</label><br>
        <select name="idkategori_klinis" id="idkategori_klinis" style="padding:8px; width:50%; border-radius:5px;">
            <option value="">-- Pilih Kategori Klinis --</option>
            @foreach($kategoriKlinis as $kk)
                <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
            @endforeach
        </select><br><br>

        <button type="submit" style="background:#d072d0; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer;">
            Simpan
        </button>
        <a href="{{ route('admin.kode.index') }}"
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           Batal
        </a>
    </form>
</div>
@endsection
