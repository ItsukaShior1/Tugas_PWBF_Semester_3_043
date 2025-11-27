@extends('layouts.lte.main')

@section('title', 'Tambah Hewan Peliharaan')

@section('content')
<div class="container">

    <h2>🐕 Tambah Hewan Peliharaan</h2>

    <a href="{{ route('resepsionis.pet.index') }}" 
       style="background:#999; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
       ← Kembali
    </a>

    <form action="{{ route('resepsionis.pet.store') }}" method="POST" style="margin-top:20px;">
        @csrf

        <label>Nama Hewan:</label>
        <input type="text" name="nama_hewan" required class="form-control"><br>

        <label>Tanggal Lahir:</label>
        <input type="date" name="tanggal_lahir" required class="form-control"><br>

        <label>Warna / Tanda Khusus:</label>
        <input type="text" name="warna_tanda" class="form-control"><br>

        <label>Jenis Kelamin:</label>
        <select name="jenis_kelamin" required class="form-control">
            <option value="">-- Pilih --</option>
            <option value="J">Jantan</option>
            <option value="B">Betina</option>
        </select><br>

        <label>Ras Hewan:</label>
        <select name="idras_hewan" required class="form-control">
            <option value="">-- Pilih Ras --</option>
            @foreach($ras as $r)
                <option value="{{ $r->idras_hewan }}">
                    {{ $r->nama_ras }} ({{ $r->jenis->nama_jenis_hewan }})
                </option>
            @endforeach
        </select><br>

        <label>Pemilik:</label>
        <select name="idpemilik" required class="form-control">
            <option value="">-- Pilih Pemilik --</option>
            @foreach($pemilik as $p)
                <option value="{{ $p->idpemilik }}">
                    {{ $p->user->nama }}
                </option>
            @endforeach
        </select><br>

        <button type="submit" 
                style="background:#4CAF50; color:white; padding:10px 18px; border:none; border-radius:6px;">
            Simpan
        </button>

    </form>
</div>
@endsection
