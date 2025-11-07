@extends('layouts.admin_layout')

@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="container">
    <h2>➕ Tambah Ras Hewan Baru</h2>
    <p>Isi form di bawah untuk menambahkan ras hewan baru.</p>

    @if ($errors->any())
        <div style="background:#ffe6e6; border-left:4px solid red; padding:10px; color:#b30000;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.ras.store') }}" method="POST" style="margin-top:15px;">
        @csrf

        <label for="nama_ras">Nama Ras:</label><br>
        <input type="text" name="nama_ras" id="nama_ras" value="{{ old('nama_ras') }}" required
               style="padding:8px; width:50%; border-radius:5px; border:1px solid #ccc;"><br><br>

        <label for="idjenis_hewan">Jenis Hewan:</label><br>
        <select name="idjenis_hewan" id="idjenis_hewan" required
                style="padding:8px; width:50%; border-radius:5px; border:1px solid #ccc;">
            <option value="">-- Pilih Jenis Hewan --</option>
            @foreach($jenisList as $jenis)
                <option value="{{ $jenis->idjenis_hewan }}">{{ $jenis->nama_jenis_hewan }}</option>
            @endforeach
        </select><br><br>

        <button type="submit" style="background:#d072d0; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer;">
            Simpan
        </button>
        <a href="{{ route('admin.ras.index') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           Batal
        </a>
    </form>
</div>
@endsection
