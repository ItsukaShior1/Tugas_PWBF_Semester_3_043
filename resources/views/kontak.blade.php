<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - RSHP</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="navbar">
        <a href="/">Home</a>
        <a href="/kontak">Kontak</a>
        <a href="/layanan">Layanan Umum</a>

        <?php if (isset($_SESSION['user'])): ?>
            <a href="/logout" style="float:right">Logout (<?= htmlspecialchars($_SESSION['user']['nama']); ?>)</a>
        <?php else: ?>
            <a href="/login" style="float:right">Login</a>
        <?php endif; ?>
    </div>

    <div class="judul">
        <img src="{{ asset('img/logo-unair.png') }}" alt="logo1" width="90px">
        <h1>HUBUNGI KAMI</h1>
        <img src="{{ asset('img/logo-unair.png') }}" alt="logo2" width="90px">
    </div>

    <section class="info-terkini">
        <h2>Informasi Kontak</h2>
        <p>Jika Anda memiliki pertanyaan, keluhan, atau ingin berkonsultasi mengenai layanan RSHP,
           silakan hubungi kami melalui informasi berikut:</p>
        <ul style="padding: 20px; font-size: 16px; color:#333;">
            <li><b>Alamat:</b> Jl. Airlangga No. 4 – Surabaya</li>
            <li><b>Telepon:</b> (031) 1234567</li>
            <li><b>Email:</b> <a href="mailto:rshp@unair.ac.id">rshp@unair.ac.id</a></li>
            <li><b>Jam Operasional:</b> Senin – Jumat, 08.00 – 17.00 WIB</li>
        </ul>

        <p>Anda juga dapat mengirim pesan melalui formulir kontak di bawah ini:</p>
        <form style="padding: 20px;">
            <label>Nama:</label><br>
            <input type="text" name="nama" style="width:100%; padding:10px; margin-bottom:10px;"><br>
            <label>Email:</label><br>
            <input type="email" name="email" style="width:100%; padding:10px; margin-bottom:10px;"><br>
            <label>Pesan:</label><br>
            <textarea name="pesan" rows="5" style="width:100%; padding:10px; margin-bottom:10px;"></textarea><br>
            <button type="submit" style="background-color:#7ed685; border:none; padding:10px 20px; border-radius:5px; cursor:pointer;">Kirim</button>
        </form>
    </section>
</body>
</html>
