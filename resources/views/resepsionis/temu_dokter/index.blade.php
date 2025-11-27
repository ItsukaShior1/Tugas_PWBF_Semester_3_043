@php
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator $temuList
     * @var \App\Models\TemuDokter $temu
     */
@endphp
@extends('layouts.lte.main')

@section('title', 'Manajemen Reservasi Temu Dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Antrian Temu Dokter</h3>
                    <div class="card-tools">
                        <a href="{{ route('resepsionis.temu_dokter.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Reservasi Baru
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    {{-- Pesan Sukses/Error --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <table id="temuDokterTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 5%">No. Urut</th>
                                <th style="width: 20%">Waktu Daftar</th>
                                <th style="width: 25%">Pet (Pasien)</th>
                                <th style="width: 20%">Pemilik</th>
                                <th style="width: 15%">Dokter</th>
                                <th style="width: 10%">Status</th>
                                <th style="width: 10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($temuList as $temu)
                            <tr>
                                <td><span class="badge bg-primary">{{ $temu->no_urut }}</span></td>
                                <td>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d-m-Y H:i') }}</td>
                                <td>{{ $temu->pet->nama_hewan ?? 'N/A' }}</td>
                                <td>{{ $temu->pet->pemilik->user->nama ?? 'N/A' }}</td>
                                <td>{{ $temu->dokter->user->nama ?? 'Belum Ditunjuk' }}</td>
                                <td>
                                    @php
                                        $statusClass = [
                                            'Menunggu' => 'badge-warning',
                                            'Proses' => 'badge-info',
                                            'Selesai' => 'badge-success',
                                            'Batal' => 'badge-danger',
                                        ][$temu->status] ?? 'badge-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }}">{{ $temu->status }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('resepsionis.temu_dokter.edit', $temu->idreservasi_dokter) }}" class="btn btn-sm btn-info" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <form action="{{ route('resepsionis.temu_dokter.destroy', $temu->idreservasi_dokter) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus reservasi ini?');" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data reservasi temu dokter.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    {{ $temuList->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection