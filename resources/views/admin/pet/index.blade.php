@extends('layouts.admin_layout')

@section('title', 'Data Hewan Peliharaan')

@section('content')
<div class="container">
    <h2>🐕 Data Hewan Peliharaan</h2>
    <p>Daftar hewan milik para pemilik.</p>

    @if(session('success'))
        <div style="color:green; margin-bottom:10px;">✅ {{ session('success') }}</div>
    @endif

    <button onclick="openCreateModal()"
            style="background:#7ed685; color:white; padding:8px 12px; border-radius:6px; border:none; cursor:pointer;">
        + Tambah Pet
    </button>

    <table class="data-table" style="width:100%; border-collapse:collapse; margin-top:20px;">
        <thead>
            <tr style="background-color:#d072d0; color:white;">
                <th>ID</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Ras</th>
                <th>Pemilik</th>
                <th>Warna Tanda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pet as $pt)
            <tr style="border-bottom:1px solid #ddd;">
                <td>{{ $pt->idpet }}</td>
                <td>{{ $pt->nama }}</td>
                <td>{{ $pt->jenis_kelamin }}</td>
                <td>{{ $pt->nama_ras }}</td>
                <td>{{ $pt->nama_pemilik }}</td>
                <td>{{ $pt->warna_tanda }}</td>

                <td>
                    <button onclick="openEditModal(
                        '{{ $pt->idpet }}',
                        '{{ $pt->nama }}',
                        '{{ $pt->jenis_kelamin }}',
                        '{{ $pt->idras_hewan }}',
                        '{{ $pt->idpemilik }}',
                        '{{ $pt->tanggal_lahir }}'
                    )"
                    style="background:#4da6ff; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                        Edit
                    </button>

                    <form action="{{ route('admin.pet.destroy', $pt->idpet) }}" 
                          method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Hapus pet ini?')"
                                style="background:#e05c5c; color:white; border:none; padding:6px 10px; border-radius:6px; cursor:pointer;">
                            Hapus
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ================= CREATE MODAL ================= --}}
<div id="createModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:420px;">
        <h3>➕ Tambah Pet</h3>

        <form action="{{ route('admin.pet.store') }}" method="POST">
            @csrf

            <label>Nama Hewan:</label>
            <input type="text" name="nama" required class="form-input">

            <label>Tanggal Lahir:</label>
            <input type="date" name="tanggal_lahir" required class="form-input">

            <label>Jenis Kelamin:</label>
            <select name="jenis_kelamin" required class="form-input">
                <option value="">-- Pilih --</option>
                <option value="Jantan">Jantan</option>
                <option value="Betina">Betina</option>
            </select>

            <label>Warna/Tanda:</label>
            <input type="text" name="warna_tanda" class="form-input">

            <label>Ras Hewan:</label>
            <select name="idras_hewan" required class="form-input">
                @foreach($ras as $r)
                <option value="{{ $r->idras_hewan }}">
                    {{ $r->nama_ras }} ({{ $r->nama_jenis_hewan }})
                </option>
                @endforeach
            </select>

            <label>Pemilik:</label>
            <select name="idpemilik" required class="form-input">
                @foreach($pemilik as $pm)
                <option value="{{ $pm->idpemilik }}">{{ $pm->nama }}</option>
                @endforeach
            </select>

            <div style="text-align:right; margin-top:10px;">
                <button type="button" onclick="closeCreateModal()" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ================= EDIT MODAL ================= --}}
<div id="editModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%;
background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
    <div style="background:white; padding:20px; border-radius:10px; width:420px;">
        <h3>✏️ Edit Pet</h3>

        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <label>Nama Hewan:</label>
            <input type="text" id="edit_nama" name="nama" required class="form-input">

            <label>Tanggal Lahir:</label>
            <input type="date" id="edit_tanggal_lahir" name="tanggal_lahir" required class="form-input">

            <label>Jenis Kelamin:</label>
            <select id="edit_jk" name="jenis_kelamin" required class="form-input">
                <option value="Jantan">Jantan</option>
                <option value="Betina">Betina</option>
            </select>

            <label>Warna/Tanda:</label>
            <input type="text" id="edit_warna" name="warna_tanda" class="form-input">

            <label>Ras Hewan:</label>
            <select id="edit_ras" name="idras_hewan" required class="form-input">
                @foreach($ras as $r)
                <option value="{{ $r->idras_hewan }}">{{ $r->nama_ras }}</option>
                @endforeach
            </select>

            <label>Pemilik:</label>
            <select id="edit_pemilik" name="idpemilik" required class="form-input">
                @foreach($pemilik as $pm)
                <option value="{{ $pm->idpemilik }}">{{ $pm->nama }}</option>
                @endforeach
            </select>

            <div style="text-align:right; margin-top:10px;">
                <button type="button" onclick="closeEditModal()" class="btn-cancel">Batal</button>
                <button type="submit" class="btn-save">Simpan</button>
            </div>
        </form>
    </div>
</div>

<style>
    .form-input {
        width:100%;
        padding:8px;
        margin-top:5px;
        margin-bottom:10px;
        border-radius:5px;
        border:1px solid #ccc;
    }
    .btn-cancel {
        background:#ccc; padding:8px 12px; border:none; border-radius:6px;
    }
    .btn-save {
        background:#7ed685; color:white; padding:8px 12px; border:none; border-radius:6px;
    }
</style>

<script>
function openCreateModal() {
    document.getElementById('createModal').style.display = 'flex';
}
function closeCreateModal() {
    document.getElementById('createModal').style.display = 'none';
}

function openEditModal(id, nama, jk, ras, pemilik, tgl) {
    document.getElementById('editForm').action = '/administrator/pet/' + id + '/update';

    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_jk').value = jk;
    document.getElementById('edit_ras').value = ras;
    document.getElementById('edit_pemilik').value = pemilik;
    document.getElementById('edit_tanggal_lahir').value = tgl;

    document.getElementById('editModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
</script>

@endsection
