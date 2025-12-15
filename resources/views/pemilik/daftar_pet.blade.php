@php

use Illuminate\Support\Facades\Auth;
$user = Auth::user();

$pets = $pets ?? collect();
@endphp

@extends('layouts.lte.main')

@section('title', 'Daftar Pet')

@section('content_header')
<h1>
Data Hewan Peliharaan
<small>Milik {{ $user->nama }}</small>
</h1>
<ol class="breadcrumb">
<li><a href="{{ route('pemilik.dashboard') }}"><i class="fa fa-tachometer-alt"></i> Dashboard</a></li>
<li class="active">Daftar Pet</li>
</ol>
@stop

@section('content')

<div class="row">
<div class="col-xs-12">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Daftar Pet milik {{ $user->nama }}</h3>
<div class="box-tools">
<a href="{{ route('pemilik.daftar_pet.create') ?? '#' }}" class="btn btn-primary btn-sm">
<i class="fa fa-plus"></i> Tambah Pet Baru
</a>
</div>
</div>
<!-- /.box-header -->
<div class="box-body">
@if ($pets->isEmpty())
<div class="callout callout-info text-center">
<h4><i class="icon fa fa-paw"></i> Tidak Ada Data Pet!</h4>
<p>Mohon daftarkan hewan peliharaan Anda untuk memulai layanan klinik.</p>
</div>
@else
<div class="table-responsive">
<table class="table table-bordered table-hover table-striped">
<thead>
<tr>
<th style="width: 5%">ID Pet</th>
<th style="width: 15%">Nama Pet</th>
<th style="width: 15%">Jenis Hewan</th>
<th style="width: 15%">Ras</th>
<th style="width: 10%">Jenis Kelamin</th>
<th style="width: 15%">Tanggal Lahir</th>
<th style="width: 15%">Warna/Tanda</th>
<th style="width: 10%">Aksi</th>
</tr>
</thead>
<tbody>
@foreach ($pets as $pet)
<tr>
<td>{{ $pet->idpet }}</td>
<td>{{ $pet->nama }}</td>
<td>{{ $pet->jenisHewan->nama_jenis_hewan ?? 'N/A' }}</td>
<td>{{ $pet->ras->nama_ras ?? 'N/A' }}</td>
<td>{{ $pet->jenis_kelamin }}</td>
<td>{{ $pet->tanggal_lahir }}</td>
<td>{{ $pet->warna_tanda }}</td>
<td>
<a href="#" class="btn btn-xs btn-default" title="Detail"><i class="fa fa-eye"></i></a>
<a href="#" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-edit"></i></a>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
@endif
</div>
<!-- /.box-body -->
</div>
<!-- /.box -->
</div>
</div>

@endsection