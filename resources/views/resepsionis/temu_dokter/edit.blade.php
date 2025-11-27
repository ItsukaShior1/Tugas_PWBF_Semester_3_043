@php
    /**
     * @var \App\Models\TemuDokter $temu
     * @var \App\Models\Pet[]|\Illuminate\Database\Eloquent\Collection $pets
     * @var \App\Models\Dokter[]|\Illuminate\Database\Eloquent\Collection $dokter
     */
@endphp
@extends('layouts.lte.main')

@section('title', 'Edit Reservasi Temu Dokter')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit Reservasi #{{ $temu->no_urut }}</h3>
                </div>
                
                <form action="{{ route('resepsionis.temu_dokter.update', $temu->idreservasi_dokter) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
                        <p><strong>Pasien:</strong> {{ $temu->pet->nama_hewan ?? 'N/A' }} (Pemilik: {{ $temu->pet->pemilik->user->nama ?? 'N/A' }})</p>
                        <p><strong>Waktu Daftar:</strong> {{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d-m-Y H:i') }}</p>
                        <hr>
                        
                        <div class="form-group">
                            <label>Pet (Pasien):</label>
                            <select name="idpet" id="idpet" class="form-control @error('idpet') is-invalid @enderror" required>
                                @foreach($pets as $pet)
                                    <option value="{{ $pet->idpet }}" {{ (old('idpet', $temu->idpet) == $pet->idpet) ? 'selected' : '' }}>
                                        {{ $pet->nama_hewan }} (Pemilik: {{ $pet->pemilik->user->nama ?? 'N/A' }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idpet')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="iddokter">Dokter yang Dituju:</label>
                            <select name="iddokter" id="iddokter" class="form-control @error('iddokter') is-invalid @enderror">
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokter as $dr)
                                    <option value="{{ $dr->iddokter }}" {{ (old('iddokter', $temu->iddokter) == $dr->iddokter) ? 'selected' : '' }}>
                                        {{ $dr->user->nama ?? 'N/A' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('iddokter')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status Antrian:</label>
                            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror" required>
                                @php
                                    $statuses = ['Menunggu', 'Proses', 'Selesai', 'Batal'];
                                @endphp
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ (old('status', $temu->status) == $status) ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">
                            <i class="fas fa-sync"></i> Perbarui Reservasi
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