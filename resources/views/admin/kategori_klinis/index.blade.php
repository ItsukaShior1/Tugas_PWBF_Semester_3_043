@extends('layouts.admin_layout')

@section('title', 'Data Kategori Klinis')

@section('content')
<div class="container">
    <h2>💉 Data Kategori Klinis</h2>
    <p>Daftar kategori pemeriksaan klinis.</p>

    {{-- Notifikasi sukses --}}
    @if(session('success'))
        <div style="color: green; margin-bottom: 10px;">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Tombol tambah --}}
    <a href="{{ route('admin.kategoriKlinis.create') }}" 
       style="background:#7ed685; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
       + Tambah Kategori Klinis
    </a>

    <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
        <thead>
            <tr style="background-color:#d072d0; color:white;">
                <th style="padding:8px;">ID</th>
                <th style="padding:8px;">Nama Kategori Klinis</th>
                <th style="padding:8px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kategoriKlinis as $k)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:8px;">{{ $k->idkategori_klinis }}</td>
                    <td style="padding:8px;">{{ $k->nama_kategori_klinis }}</td>
                    <td style="padding:8px;">
                        <button type="button"
                                onclick="openEditModal('{{ $k->idkategori_klinis }}', '{{ $k->nama_kategori_klinis }}')"
                                style="background:#7ed685; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                            Edit
                        </button>

                        <form action="{{ route('admin.kategoriKlinis.destroy', $k->idkategori_klinis) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Yakin ingin menghapus kategori klinis ini?')"
                                    style="background:#e05c5c; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center; padding:12px; color:#999;">
                        Belum ada data kategori klinis.
                    </td>
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
        <h3>✏️ Edit Kategori Klinis</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label for="edit_nama_kategori_klinis">Nama Kategori Klinis:</label><br>
            <input type="text" id="edit_nama_kategori_klinis" name="nama_kategori_klinis" required
                   style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <div style="text-align:right;">
                <button type="button" onclick="closeEditModal()"
                        style="background:#ccc; color:black; padding:8px 12px; border:none; border-radius:5px;">
                    Batal
                </button>
                <button type="submit"
                        style="background:#7ed685; color:white; padding:8px 12px; border:none; border-radius:5px;">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama) {
        document.getElementById('editForm').action = '/administrator/kategori-klinis/' + id + '/update';
        document.getElementById('edit_nama_kategori_klinis').value = nama;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
@endsection
