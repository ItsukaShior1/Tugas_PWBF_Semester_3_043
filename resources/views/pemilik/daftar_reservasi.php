@extends('layouts.lte.main')

@section('title', 'Daftar Reservasi')

@section('content_header')
<div class="bg-white rounded-xl shadow-2xl p-6 md:p-10">
<h2 class="text-3xl font-extrabold text-primary-dark mb-6 border-b-4 border-primary-dark pb-3">
Daftar Reservasi Temu Dokter
</h2>

    @if ($reservasi->isEmpty())
        <div class="text-center bg-gray-50 p-8 rounded-xl shadow-inner mt-4">
            <p class="text-xl text-gray-500 font-medium">📆 Belum ada reservasi temu dokter yang terdaftar.</p>
            <button class="mt-4 px-6 py-2 bg-primary-dark text-white rounded-lg shadow hover:bg-accent-dark transition">
                + Buat Reservasi Baru
            </button>
        </div>
    @else
        <div class="overflow-x-auto table-container">
            <table class="min-w-full divide-y divide-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-accent-light">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">ID Reservasi</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Nama Pet</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">No Urut</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Waktu Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($reservasi as $r)
                        <tr class="hover:bg-purple-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-label="ID Reservasi">{{ $r->idreservasi_dokter }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" data-label="Nama Pet">{{ $r->pet->nama ?? 'Pet Dihapus' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="No Urut">{{ $r->no_urut }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Waktu Daftar">{{ $r->waktu_daftar }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm" data-label="Status">
                                @php
                                    $statusClass = [
                                        'SELESAI' => 'bg-green-100 text-green-800',
                                        'MENUNGGU' => 'bg-yellow-100 text-yellow-800',
                                        'DIBATALKAN' => 'bg-red-100 text-red-800',
                                    ][strtoupper($r->status)] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $r->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


@endsection