@extends('layouts.lte.main')

@php
    /**
     * @var \Illuminate\Pagination\LengthAwarePaginator $rekamList
     * @var int $reservasiTemuCount
     */
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp

@section('title', 'Daftar Rekam Medis')

@section('content_header')
<h1>
Daftar Rekam Medis
<small>Kelola data anamnesa dan temuan klinis pasien</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('perawat.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
    <li class="active">Rekam Medis</li>
</ol>
@stop

@section('content')

@if (session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fas fa-check"></i> Berhasil!</h4>
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fas fa-ban"></i> Error!</h4>
        {{ session('error') }}
    </div>
@endif

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Data Rekam Medis</h3>
        <div class="box-tools">
            @if ($reservasiTemuCount === 0) 
                <button type="button" class="btn btn-primary" disabled 
                        data-toggle="tooltip" data-placement="top" 
                        title="Tidak ada reservasi Temu Dokter yang siap dibuat Rekam Medis baru (Status harus 'Menunggu' atau 'Proses' dan belum memiliki Rekam Medis).">
                    <i class="fas fa-plus"></i> Tambah Rekam Medis
                </button>
            @else
                <a href="{{ route('perawat.rekam-medis.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Rekam Medis
                </a>
            @endif
        </div>
    </div>
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th style="width: 5%">ID RM</th>
                        <th>No. Urut</th>
                        <th style="width: 12%">Waktu Daftar</th>
                        <th>Pasien (Pemilik)</th>
                        <th>Dokter Pemeriksa</th>
                        <th style="width: 15%">Anamnesa</th>
                        <th style="width: 15%">Temuan Klinis</th>
                        <th style="width: 15%">Diagnosa</th>
                        <th style="width: 10%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rekamList as $rm)
                        <tr>
                            <td>{{ $rm->idrekam_medis }}</td>
                            <td>{{ $rm->reservasi->no_urut ?? '-' }}</td>
                            <td>{{ optional(Carbon::parse($rm->reservasi->waktu_daftar ?? null))->format('d M Y H:i') ?? '-' }}</td>
                            <td>
                                {{ $rm->reservasi->pet->nama_pet ?? '-' }}
                                ({{ $rm->reservasi->pet->pemilik->user->nama ?? '-' }})
                            </td>
                            <td>{{ $rm->dokterPemeriksa->user->nama ?? 'N/A' }}</td>
                            <td>{{ Str::limit($rm->anamnesa, 50) }}</td>
                            <td>{{ Str::limit($rm->temuan_klinis, 50) }}</td> 
                            <td>{{ Str::limit($rm->diagnosa, 50) }}</td>
                            <td>
                                <a href="{{ route('perawat.rekam-medis.show', $rm->idrekam_medis) }}" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                                <a href="{{ route('perawat.rekam-medis.edit', $rm->idrekam_medis) }}" class="btn btn-xs btn-warning" title="Edit"><i class="fas fa-edit"></i></a>
                                
                                <form action="{{ route('perawat.rekam-medis.destroy', $rm->idrekam_medis) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus Rekam Medis ini? Tindakan ini akan di-soft delete.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-xs btn-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Belum ada data Rekam Medis.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $rekamList->links() }}
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
@endpush