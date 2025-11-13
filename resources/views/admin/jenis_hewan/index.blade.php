@extends('layouts.admin_layout')

@section('title', 'Data Jenis Hewan')

@section('content')
<div class="container">
    <h2>🐾 Data Jenis Hewan</h2>
    <p>Daftar semua jenis hewan yang tersedia di sistem.</p>

    @if(session('success'))
        <div style="background:#e7ffe7; border-left:4px solid #28a745; padding:10px; margin-bottom:15px; color:#1d6f32;">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.jenis.create') }}" 
       style="background:#7ed685; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
       + Tambah Jenis Hewan
    </a>

    <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
        <thead>
            <tr style="background-color:#d072d0; color:white;">
                <th style="padding:8px;">ID</th>
                <th style="padding:8px;">Nama Jenis Hewan</th>
                <th style="padding:8px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($jenisHewan as $jenis)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:8px;">{{ $jenis->idjenis_hewan }}</td>
                    <td style="padding:8px;">{{ $jenis->nama_jenis_hewan }}</td>
                    <td style="padding:8px;">
                       
                        <button 
                            type="button" 
                            onclick="openEditModal({{ $jenis->idjenis_hewan }}, '{{ $jenis->nama_jenis_hewan }}')" 
                            style="color:#007bff; background:none; border:none; cursor:pointer;">
                            Edit
                        </button> |
                     
                        <form action="{{ route('admin.jenis.destroy', $jenis->idjenis_hewan) }}" 
                              method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                style="background:none; border:none; color:red; cursor:pointer;"
                                onclick="return confirm('Hapus jenis hewan ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" style="text-align:center; color:#999; padding:10px;">
                        Belum ada data jenis hewan.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px;">
        <a href="{{ route('admin.data.master') }}" 
           style="background:#7ed685; color:white; padding:10px 16px; border-radius:8px; text-decoration:none;">
           ← Kembali ke Data Master
        </a>
    </div>
</div>

<div id="editModal" 
     style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
            background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:400px; position:relative;">
        <h3 style="margin-bottom:10px;">✏️ Edit Jenis Hewan</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <label for="edit_nama_jenis_hewan">Nama Jenis Hewan:</label><br>
            <input type="text" id="edit_nama_jenis_hewan" name="nama_jenis_hewan" 
                   style="width:100%; padding:8px; border:1px solid #ccc; border-radius:5px; margin-top:5px;" required><br><br>
            
            <div style="text-align:right;">
                <button type="button" onclick="closeEditModal()" 
                        style="background:#aaa; color:white; padding:8px 12px; border:none; border-radius:5px; margin-right:5px;">
                    Batal
                </button>
                <button type="submit" 
                        style="background:#d072d0; color:white; padding:8px 12px; border:none; border-radius:5px;">
                    Simpan
                </button>
            </div>
        </form>
        
        <button onclick="closeEditModal()" 
                style="position:absolute; top:10px; right:10px; background:none; border:none; font-size:18px; cursor:pointer;">
            ✖
        </button>
    </div>
</div>

<script>
    function openEditModal(id, nama) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        const input = document.getElementById('edit_nama_jenis_hewan');

        input.value = nama;

        form.action = `/administrator/jenis-hewan/${id}/update`;

        modal.style.display = 'flex';
    }

    function closeEditModal() {
        const modal = document.getElementById('editModal');
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) {
            closeEditModal();
        }
    };
</script>
@endsection
