@extends('layouts.admin_layout')

@section('title', 'Data Kode Tindakan')

@section('content')
<div class="container">
    <h2>🧾 Data Kode Tindakan Terapi</h2>
    <p>Daftar tindakan dan terapi yang tersedia.</p>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">✅ {{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.kode.create') }}" 
       style="background:#7ed685; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
       + Tambah Kode Tindakan
    </a>

    <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
        <thead>
            <tr style="background-color:#d072d0; color:white;">
                <th style="padding:8px;">ID</th>
                <th style="padding:8px;">Kode</th>
                <th style="padding:8px;">Deskripsi</th>
                <th style="padding:8px;">Kategori</th>
                <th style="padding:8px;">Kategori Klinis</th>
                <th style="padding:8px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kodeTindakan as $kode)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:8px;">{{ $kode->idkode_tindakan_terapi }}</td>
                    <td style="padding:8px;">{{ $kode->kode }}</td>
                    <td style="padding:8px;">{{ $kode->deskripsi_tindakan_terapi }}</td>
                    <td style="padding:8px;">{{ $kode->kategori->nama_kategori ?? '-' }}</td>
                    <td style="padding:8px;">{{ $kode->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>
                    <td style="padding:8px;">
                        <button onclick="openEditModal('{{ $kode->idkode_tindakan_terapi }}', '{{ $kode->kode }}', '{{ $kode->deskripsi_tindakan_terapi }}', '{{ $kode->idkategori }}', '{{ $kode->idkategori_klinis }}')" 
                                style="background:#7ed685; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                            Edit
                        </button>
                        <form action="{{ route('admin.kode.destroy', $kode->idkode_tindakan_terapi) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus kode tindakan ini?')"
                                    style="background:#e05c5c; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align:center; padding:12px;">Belum ada data kode tindakan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.data.master') }}" 
           style="background:#aaa; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           ← Kembali ke Data Master
        </a>
    </div>
</div>

{{-- Modal Edit --}}
<div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:400px;">
        <h3>✏️ Edit Kode Tindakan</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label for="edit_kode">Kode:</label><br>
            <input type="text" id="edit_kode" name="kode" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label for="edit_deskripsi">Deskripsi:</label><br>
            <input type="text" id="edit_deskripsi" name="deskripsi_tindakan_terapi" required style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label for="edit_kategori">Kategori:</label><br>
            <select id="edit_kategori" name="idkategori" style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select><br>

            <label for="edit_kategori_klinis">Kategori Klinis:</label><br>
            <select id="edit_kategori_klinis" name="idkategori_klinis" style="width:100%; padding:8px; margin-bottom:10px;">
                <option value="">-- Pilih Kategori Klinis --</option>
                @foreach($kategoriKlinis as $kk)
                    <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                @endforeach
            </select><br>

            <div style="text-align:right;">
                <button type="button" onclick="closeEditModal()" style="background:#ccc; color:black; padding:8px 12px; border:none; border-radius:5px;">Batal</button>
                <button type="submit" style="background:#7ed685; color:white; padding:8px 12px; border:none; border-radius:5px;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, kode, deskripsi, idkategori, idkategoriKlinis) {
        document.getElementById('editForm').action = '/administrator/kode-tindakan/' + id + '/update';
        document.getElementById('edit_kode').value = kode;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_kategori').value = idkategori;
        document.getElementById('edit_kategori_klinis').value = idkategoriKlinis;
        document.getElementById('editModal').style.display = 'flex';
    }
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
@endsection
