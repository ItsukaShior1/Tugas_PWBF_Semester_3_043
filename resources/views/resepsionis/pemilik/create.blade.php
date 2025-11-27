@extends('layouts.lte.main')

@section('title', 'Tambah Pemilik')

@section('content')
<div class="container">
    <h2>➕ Tambah Pemilik Baru</h2>
    <p>Isi form di bawah untuk menambahkan pemilik hewan ke dalam sistem.</p>

    @if ($errors->any())
        <div style="color:red; margin-bottom:10px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('resepsionis.pemilik.store') }}" method="POST" style="margin-top:15px;">
        @csrf

        <label for="nama">Nama Pemilik:</label><br>
        <input type="text" name="nama" id="nama" required
               style="padding:8px; width:50%; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" required
               style="padding:8px; width:50%; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required
               style="padding:8px; width:50%; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"><br>

        <label for="password_confirmation">Ulangi Password:</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" required
               style="padding:8px; width:50%; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"><br>

        <label for="no_wa">No. WhatsApp:</label><br>
        <input type="text" name="no_wa" id="no_wa" required
               style="padding:8px; width:50%; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"><br>

        <label for="alamat">Alamat:</label><br>
        <input type="text" name="alamat" id="alamat" required
               style="padding:8px; width:50%; margin-bottom:10px; border-radius:5px; border:1px solid #ccc;"><br>

        <button type="submit" style="background:#d072d0; color:white; padding:10px 18px; border:none; border-radius:8px;">
            Simpan
        </button>
        <a href="{{ route('resepsionis.pemilik.index') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           Batal
        </a>
    </form>
</div>
@endsection
