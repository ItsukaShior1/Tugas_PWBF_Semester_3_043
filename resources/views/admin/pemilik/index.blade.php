@extends('layouts.admin_layout')

@section('title', 'Data Pemilik')

@section('content')
<div class="container">
    <h2>👤 Data Pemilik</h2>
    <p>Daftar pemilik hewan yang terdaftar di sistem.</p>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">✅ {{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.pemilik.create') }}" 
       style="background:#7ed685; color:white; padding:8px 12px; border-radius:6px; text-decoration:none;">
       + Tambah Pemilik
    </a>

    <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
        <thead>
            <tr style="background-color:#d072d0; color:white;">
                <th style="padding:8px;">ID</th>
                <th style="padding:8px;">Nama</th>
                <th style="padding:8px;">Email</th>
                <th style="padding:8px;">No. WA</th>
                <th style="padding:8px;">Alamat</th>
                <th style="padding:8px;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pemilik as $p)
                <tr style="border-bottom:1px solid #ddd;">
                    <td style="padding:8px;">{{ $p->idpemilik }}</td>
                    <td style="padding:8px;">{{ $p->user->nama ?? '-' }}</td>
                    <td style="padding:8px;">{{ $p->user->email ?? '-' }}</td>
                    <td style="padding:8px;">{{ $p->no_wa ?? '-' }}</td>
                    <td style="padding:8px;">{{ $p->alamat ?? '-' }}</td>
                    <td style="padding:8px;">
                        <button onclick="openEditModal('{{ $p->idpemilik }}', '{{ $p->user->nama }}', '{{ $p->user->email }}', '{{ $p->no_wa }}', '{{ $p->alamat }}')"
                                style="background:#72a8d0; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                            Edit
                        </button>
                        <form action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Yakin ingin menghapus data pemilik ini?')"
                                    style="background:#e05c5c; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align:center; padding:12px;">Belum ada data pemilik.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Modal Edit --}}
<div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:400px;">
        <h3>✏️ Edit Data Pemilik</h3>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label>Nama:</label>
            <input type="text" id="edit_nama" name="nama" required
                   style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Email:</label>
            <input type="email" id="edit_email" name="email" required
                   style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>No. WA:</label>
            <input type="text" id="edit_no_wa" name="no_wa" required
                   style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <label>Alamat:</label>
            <input type="text" id="edit_alamat" name="alamat" required
                   style="width:100%; padding:8px; margin-bottom:10px;"><br>

            <div style="text-align:right;">
                <button type="button" onclick="closeEditModal()" style="background:#ccc; padding:8px 12px; border:none; border-radius:5px;">Batal</button>
                <button type="submit" style="background:#7ed685; color:white; padding:8px 12px; border:none; border-radius:5px;">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama, email, wa, alamat) {
        document.getElementById('editForm').action = '/administrator/pemilik/' + id + '/update';
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_no_wa').value = wa;
        document.getElementById('edit_alamat').value = alamat;
        document.getElementById('editModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
    }
</script>
@endsection
