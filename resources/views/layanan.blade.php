<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan - RSHP</title>
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
        <h1>LAYANAN RSHP</h1>
        <img src="{{ asset('img/logo-unair.png') }}" alt="logo2" width="90px">
    </div>

    <section class="info-terkini">
        <h2>Layanan Medis yang Kami Sediakan</h2>
        <p>RSHP menyediakan berbagai layanan kesehatan hewan untuk memastikan setiap pasien mendapat
           perawatan terbaik sesuai kebutuhannya.</p>

        <ul style="padding: 20px; font-size: 16px; color:#333;">
            <li><b>Rawat Jalan:</b> Pemeriksaan umum dan tindakan medis ringan tanpa menginap.</li>
            <li><b>Rawat Inap:</b> Fasilitas untuk hewan yang memerlukan perawatan intensif.</li>
            <li><b>Vaksinasi:</b> Program vaksin lengkap untuk mencegah penyakit menular.</li>
            <li><b>Laboratorium:</b> Pemeriksaan darah, urin, feses, dan kultur bakteri.</li>
            <li><b>Radiologi & USG:</b> Pemeriksaan diagnostik modern dengan hasil cepat dan akurat.</li>
            <li><b>Konsultasi Gizi & Rehabilitasi:</b> Layanan tambahan untuk pemulihan kesehatan hewan.</li>
        </ul>

        <h3 style="padding: 20px;">Jadwal Pelayanan</h3>
        <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; text-align: center;">
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>Hari</td>
                <td>Jam Operasional</td>
                <td>Keterangan</td>
            </tr>
            <tr>
                <td>Senin – Jumat</td>
                <td>08.00 – 17.00 WIB</td>
                <td>Pelayanan penuh</td>
            </tr>
            <tr>
                <td>Sabtu</td>
                <td>08.00 – 12.00 WIB</td>
                <td>Pelayanan terbatas</td>
            </tr>
            <tr>
                <td>Minggu</td>
                <td>Tutup</td>
                <td>-</td>
            </tr>
        </table>
    </section>
</body>
</html>
