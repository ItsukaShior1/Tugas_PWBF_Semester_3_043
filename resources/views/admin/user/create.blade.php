@extends('layouts.admin_layout')

@section('title', 'Tambah User')

@section('content')
<div class="container">
    <h2>➕ Tambah User Baru</h2>
    <p>Isi form di bawah untuk menambahkan user baru.</p>

    @if ($errors->any())
        <div style="background:#ffe6e6; border-left:4px solid red; padding:10px; color:#b30000;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>⚠️ {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user.store') }}" method="POST" style="margin-top:15px;">
        @csrf

        <label for="nama">Nama:</label><br>
        <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
               style="padding:8px; width:50%; border-radius:5px; border:1px solid #ccc;"><br><br>

        <label for="email">Email:</label><br>
        <input type="email" name="email" id="email" value="{{ old('email') }}" required
               style="padding:8px; width:50%; border-radius:5px; border:1px solid #ccc;"><br><br>

        <label for="password">Password:</label><br>
        <input type="password" name="password" id="password" required
               style="padding:8px; width:50%; border-radius:5px; border:1px solid #ccc;"><br><br>

        <label for="password_confirmation">Retype Password:</label><br>
        <input type="password" name="password_confirmation" id="password_confirmation" required
               style="padding:8px; width:50%; border-radius:5px; border:1px solid #ccc;"><br><br>

        <button type="submit" style="background:#26b4be; color:white; padding:10px 18px; border:none; border-radius:8px; cursor:pointer;">
            Simpan
        </button>
        <a href="{{ route('admin.user.index') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           Batal
        </a>
    </form>
</div>
@endsection
