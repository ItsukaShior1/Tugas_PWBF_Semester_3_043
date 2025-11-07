<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
</head>
<body>
    <div class="navbar">
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('kontak') }}">Kontak</a>
        <a href="{{ route('layanan') }}">Layanan Umum</a>

        {{-- 🔐 Cek apakah user sudah login --}}
        @auth
            <form action="{{ route('logout') }}" method="POST" style="float:right; display:inline;">
                @csrf
                <button type="submit" style="
                    background:none;
                    border:none;
                    color:white;
                    cursor:pointer;
                    font-size:16px;
                ">
                    Logout ({{ Auth::user()->nama }})
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" style="float:right">Login</a>
        @endauth
    </div>

    <div class="judul">
        <img src="{{ asset('img/logo-unair.png') }}" alt="logo1" width="90px">
        <h1>WELCOME TO RSHP</h1>
        <img src="{{ asset('img/logo-unair.png') }}" alt="logo1" width="90px">
    </div>

    <section class="info-terkini">
        <img src="{{ asset('img/OIP.webp') }}" alt="logors" width="90px">
        <h2>Informasi Terkini</h2>
        <p>
            RSHP berkomitmen untuk memberikan pelayanan terbaik kepada masyarakat.
            Kami terus meningkatkan fasilitas dan kualitas tenaga medis agar setiap pasien
            mendapatkan penanganan yang cepat dan tepat.
        </p>
        <p>
            Saat ini, kami sedang mengembangkan sistem pendaftaran online yang memudahkan pasien
            untuk mendapatkan nomor antrean tanpa perlu menunggu lama di rumah sakit.
        </p>
        <p>
            Untuk informasi lebih lanjut, silakan hubungi nomor layanan kami atau kunjungi halaman resmi RSHP.
        </p>
    </section>

    <section class="struktur-organisasi">
        <h2><b>Struktur Organisasi</b></h2>
        <table border="1" cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; text-align: center;">
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td colspan="2">DIREKTUR</td>
            </tr>
            <tr>
                <td colspan="2">Dr. Ira Sari Yudaniayanti, M.P., drh.</td>
            </tr>
            <tr style="background-color: #f2f2f2; font-weight: bold;">
                <td>Wakil Direktur 1</td>
                <td>Wakil Direktur 2</td>
            </tr>
            <tr>
                <td>Dr. Nusdianto Triakoso, M.P., drh.</td>
                <td>Dr. Miyayu Soneta S., M.Vet., drh.</td>
            </tr>
        </table>
    </section>

    <section class="layananumum">
        <h1>Layanan Umum</h1>
        <h2>Poliklinik</h2>
        <p>
            Poliklinik adalah layanan rawat jalan dimana pelayanan kesehatan hewan dilakukan tanpa pasien menginap.
            Poliklinik melayani tindakan observasi, diagnosis, pengobatan, rehabilitasi medik, serta pelayanan kesehatan lainnya seperti permintaan surat keterangan sehat.
            Tindakan observasi dan diagnosis juga bisa diteguhkan dengan berbagai macam pemeriksaan yang bisa kami lakukan, misalnya pemeriksaan sitologi, dermatologi, hematologi, atau pemeriksaan radiologi, ultrasonografi, bahkan pemeriksaan elektrokardiografi.
            Bilamana diperlukan pemeriksaan lain seperti kultur bakteri, atau pemeriksaan jaringan/histopatologi, kami bekerja sama dengan Fakultas Kedokteran Hewan Universitas Airlangga untuk membantu melakukan pemeriksaan-pemeriksaan tersebut.
            Selain itu kami mempunyai rapid test untuk pemeriksaan cepat, untuk meneguhkan diagnosa penyakit-penyakit berbahaya pada kucing seperti panleukopenia, calicivirus, rhinotracheitis, FIP, dan pada anjing seperti parvovirus, canine distemper.
        </p>
        <p>
            Layanan kesehatan yang kami layani antara lain:
        </p>
        <ul>
            <li>Rawat jalan</li>
            <li>Vaksinasi</li>
            <li>Akupuntur</li>
            <li>Kemoterapi</li>
        </ul>
    </section>

    <section class="visimisi">
        <h1>Visi Misi dan Tujuan</h1>
        <h3>Visi</h3>
        <p><i>Menjadi Pusat kesehatan hewan terdepan di Indonesia</i></p>
        <h3>Misi</h3>
        <ol>
            <li>Menyediakan layanan medis</li>
            <li>Mendukung kegiatan medis</li>
            <li>Meningkatkan kualitas kesehatan hewan di Indonesia</li>
        </ol>
        <h3>Tujuan</h3>
        <p>Meningkatkan kualitas kesehatan hewan di Indonesia</p>
    </section>
</body>
</html>
