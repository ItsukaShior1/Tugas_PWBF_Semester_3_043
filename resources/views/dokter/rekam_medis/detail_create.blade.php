
@extends('layouts.lte.main')

@section('title', 'Tambah Detail Tindakan')

<?php
/**
 * @var \App\Models\RekamMedis $rekam 
 * @var \Illuminate\Database\Eloquent\Collection|\App\Models\KodeTindakan[] $kodeTindakanList
 */
?>

@section('content')

<div class="container-fluid">
        <h2 class="fw-bold mb-4">Tambah Detail Tindakan untuk RM {{ $rekam->idrekam_medis }}</h2>

     <div class="card shadow-sm">
            <div class="card-body">
            <form action="{{ route('dokter.rekamMedis.detail.store', $rekam->idrekam_medis) }}" method="POST">
            @csrf

            <div class="mb-3">
            <label for="idkode_tindakan_terapi" class="form-label">Kode Tindakan/Terapi <span class="text-danger">*</span></label>
                    <select class="form-control @error('idkode_tindakan_terapi') is-invalid @enderror" id="idkode_tindakan_terapi" name="idkode_tindakan_terapi" required>
                        <option value="">Pilih Tindakan</option>
                        @foreach ($kodeTindakanList as $kode)
                        <option value="{{ $kode->idkode_tindakan_terapi }}" {{ old('idkode_tindakan_terapi') == $kode->idkode_tindakan_terapi ? 'selected' : '' }}>
                         **{{ $kode->kode }}** - {{ $kode->deskripsi_tindakan_terapi }}
                         </option>
                         @endforeach
                        </select>
                         @error('idkode_tindakan_terapi')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                             </div>

                            <div class="mb-3">
                            <label for="detail" class="form-label">Detail Spesifik (Opsional)</label>
                            <textarea class="form-control @error('detail') is-invalid @enderror" id="detail" name="detail" rows="3">{{ old('detail') }}</textarea>
                            @error('detail')
                            <div class="invalid-feedback">{{ $message }}</div>
                             @enderror
                            </div>

                            <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Simpan Detail</button>
                                <a href="{{ route('dokter.rekamMedis.show', $rekam->idrekam_medis) }}" class="btn btn-secondary">Batal</a>
                            </div>
                         </form>
                    </div>
            </div>
</div>

@endsection