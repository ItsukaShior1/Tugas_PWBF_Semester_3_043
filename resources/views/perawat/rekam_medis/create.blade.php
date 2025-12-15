@extends('layouts.lte.main')

@php
/**
* @var \App\Models\TemuDokter[]|\Illuminate\Support\Collection $reservasiTemu
* @var \App\Models\Dokter[]|\Illuminate\Support\Collection $dokterList
*/
use Illuminate\Support\Str;
@endphp

@section('title', 'Tambah Rekam Medis Baru')

@section('content_header')

<h1>
Tambah Rekam Medis Baru
<small>Isi data anamnesa awal pasien dan penentuan dokter pemeriksa</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{ route('perawat.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Home</a></li>
<li><a href="{{ route('perawat.rekam-medis.index') }}">Rekam Medis</a></li>
<li class="active">Tambah</li>
</ol>
@stop

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-check"></i> Berhasil!</h4>
{{ session('success') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible">
<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
<h4><i class="icon fa fa-ban"></i> Gagal!</h4>
{{ session('error') }}
</div>
@endif

<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Form Tambah Rekam Medis</h3>
</div>

<form method="POST" action="{{ route('perawat.rekam-medis.store') }}">
    @csrf
    <div class="box-body">
        
        <div class="form-group @error('idreservasi_dokter') has-error @enderror">
            <label for="idreservasi_dokter">Reservasi Dokter <span class="text-danger">*</span></label>
            <select class="form-control select2" style="width: 100%;" id="idreservasi_dokter" name="idreservasi_dokter" required>
                <option value="">-- Pilih Reservasi --</option>
                @foreach ($reservasiTemu as $temu)
                    <option value="{{ $temu->idreservasi_dokter }}" {{ old('idreservasi_dokter') == $temu->idreservasi_dokter ? 'selected' : '' }}>
                        No. {{ $temu->no_urut }} - {{ $temu->pet->nama_pet ?? 'N/A' }} ({{ $temu->pet->pemilik->user->nama ?? 'N/A' }})
                    </option>
                @endforeach
            </select>
            @error('idreservasi_dokter')<span class="help-block">{{ $message }}</span>@enderror
        </div>

        <div class="form-group @error('dokter_pemeriksa') has-error @enderror">
            <label for="dokter_pemeriksa">Dokter Pemeriksa <span class="text-danger">*</span></label>
            <select class="form-control select2" id="dokter_pemeriksa" name="dokter_pemeriksa" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach ($dokterList as $dokter)
                    <option value="{{ $dokter->iddokter }}" {{ old('dokter_pemeriksa') == $dokter->iddokter ? 'selected' : '' }}>
                        {{ $dokter->user->nama ?? 'N/A' }}
                    </option>
                @endforeach
            </select>
            @error('dokter_pemeriksa')<span class="help-block">{{ $message }}</span>@enderror
        </div>

        {{-- ANAMNESA --}}
        <div class="form-group @error('anamnesa') has-error @enderror">
            <label for="anamnesa">Anamnesa <span class="text-danger">*</span></label>
            <textarea class="form-control" id="anamnesa" name="anamnesa" rows="3" required>{{ old('anamnesa') }}</textarea>
            @error('anamnesa')<span class="help-block">{{ $message }}</span>@enderror
        </div>
        
        {{-- TEMUAN KLINIS --}}
        <div class="form-group @error('temuan_klinis') has-error @enderror">
            <label for="temuan_klinis">Temuan Klinis <span class="text-danger">*</span></label>
            <textarea class="form-control" id="temuan_klinis" name="temuan_klinis" rows="3" required>{{ old('temuan_klinis') }}</textarea>
            @error('temuan_klinis')<span class="help-block">{{ $message }}</span>@enderror
        </div>
        
        {{-- DIAGNOSA --}}
        <div class="form-group @error('diagnosa') has-error @enderror">
            <label for="diagnosa">Diagnosa <span class="text-danger">*</span></label>
            <textarea class="form-control" id="diagnosa" name="diagnosa" rows="3" required>{{ old('diagnosa') }}</textarea>
            @error('diagnosa')<span class="help-block">{{ $message }}</span>@enderror
        </div>

    </div>
    <div class="box-footer">
        <a href="{{ route('perawat.rekam-medis.index') }}" class="btn btn-default">Batal</a>
        <button type="submit" class="btn btn-primary pull-right">Simpan Rekam Medis</button>
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