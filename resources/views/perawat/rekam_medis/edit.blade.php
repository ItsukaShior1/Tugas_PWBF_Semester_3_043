@extends('layouts.lte.main')

@php
    /**
     * @var \App\Models\RekamMedis $rekamMedis
     * @var \App\Models\Dokter[]|\Illuminate\Support\Collection $dokterList
     */
    use Illuminate\Support\Str;
@endphp

@section('title', 'Edit Rekam Medis: RM#'.$rekamMedis->idrekam_medis)

@section('content_header')
<h1>
Edit Rekam Medis: RM#{{ $rekamMedis->idrekam_medis }}
<small>Perbarui data anamnesa dan temuan klinis pasien</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{ route('perawat.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
    <li><a href="{{ route('perawat.rekam-medis.index') }}">Rekam Medis</a></li>
    <li class="active">Edit</li>
</ol>
@stop

@section('content')

<div class="box box-warning">
    <div class="box-header with-border">
        <h3 class="box-title">Form Edit Rekam Medis</h3>
    </div>
    
    <form method="POST" action="{{ route('perawat.rekam-medis.update', $rekamMedis->idrekam_medis) }}">
        @csrf
        @method('PUT')
        
        <div class="box-body">
            
            <div class="form-group">
                <label for="idreservasi_dokter">Reservasi Dokter</label>
                <input type="text" class="form-control" value="No. {{ $rekamMedis->reservasi->no_urut ?? 'N/A' }} - {{ $rekamMedis->reservasi->pet->nama_pet ?? 'N/A' }} ({{ $rekamMedis->reservasi->pet->pemilik->user->nama ?? 'N/A' }})" disabled>
                <small class="text-info">Reservasi tidak dapat diubah setelah Rekam Medis dibuat.</small>
            </div>

            <div class="form-group @error('dokter_pemeriksa') has-error @enderror">
                <label for="dokter_pemeriksa">Dokter Pemeriksa <span class="text-danger">*</span></label>
                <select class="form-control select2" id="dokter_pemeriksa" name="dokter_pemeriksa" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokterList as $dokter)
                        <option value="{{ $dokter->iddokter }}" 
                            {{ (old('dokter_pemeriksa', $rekamMedis->dokter_pemeriksa) == $dokter->iddokter) ? 'selected' : '' }}>
                            {{ $dokter->user->nama ?? 'N/A' }}
                        </option>
                    @endforeach
                </select>
                @error('dokter_pemeriksa')<span class="help-block">{{ $message }}</span>@enderror
            </div>

            {{-- ANAMNESA --}}
            <div class="form-group @error('anamnesa') has-error @enderror">
                <label for="anamnesa">Anamnesa <span class="text-danger">*</span></label>
                <textarea class="form-control" id="anamnesa" name="anamnesa" rows="3" required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                @error('anamnesa')<span class="help-block">{{ $message }}</span>@enderror
            </div>
            
            {{-- TEMUAN KLINIS --}}
            <div class="form-group @error('temuan_klinis') has-error @enderror">
                <label for="temuan_klinis">Temuan Klinis <span class="text-danger">*</span></label>
                <textarea class="form-control" id="temuan_klinis" name="temuan_klinis" rows="3" required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                @error('temuan_klinis')<span class="help-block">{{ $message }}</span>@enderror
            </div>
            
            {{-- DIAGNOSA --}}
            <div class="form-group @error('diagnosa') has-error @enderror">
                <label for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
                <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                @error('diagnosa')<span class="help-block">{{ $message }}</span>@enderror
            </div>

        </div>
        <div class="box-footer">
            <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-default">Batal</a>
            <button type="submit" class="btn btn-warning pull-right">Perbarui Rekam Medis</button>
        </div>
    </form>
</div>

@endsection

@push('scripts')
<script>
    $(function () {
        $('.select2').select2();
    });
</script>
@endpush