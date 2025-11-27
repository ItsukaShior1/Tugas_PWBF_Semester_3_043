@extends('layouts.lte.main')

@section('title', 'Buat Reservasi Temu Dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Form Reservasi Baru</h3>
                </div>
                
                <form action="{{ route('resepsionis.temu_dokter.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        
                        <div class="form-group">
                            <label for="idpet">Pilih Pet (Pasien):</label>
                            <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Pet --</option>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->idpet }}" {{ old('idpet') == $pet->idpet ? 'selected' : '' }}>
                                        {{ $pet->nama_hewan }} (Pemilik: {{ $pet->pemilik->user->nama ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idpet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="iddokter">Dokter yang Dituju (Opsional):</label>
                            <select name="iddokter" id="iddokter" class="form-control @error('iddokter') is-invalid @enderror">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokter as $dr)
                                    <option value="{{ $dr->iddokter }}" {{ old('iddokter') == $dr->iddokter ? 'selected' : '' }}>
                                        {{ $dr->user->nama ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('iddokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status Awal:</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                <option value="Menunggu" selected>Menunggu</option>
                                <option value="Proses">Proses</option>
                                <option value="Selesai">Selesai</option>
                                <option value="Batal">Batal</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Reservasi
                        </button>
                        <a href="{{ route('resepsionis.temu_dokter.index') }}" class="btn btn-default">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection