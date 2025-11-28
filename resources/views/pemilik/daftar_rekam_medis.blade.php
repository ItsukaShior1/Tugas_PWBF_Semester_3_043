@extends('layouts.lte,main')

@section('title', 'Daftar Rekam Medis')

@section('content_header')
<div class="bg-white rounded-xl shadow-2xl p-6 md:p-10">
<h2 class="text-3xl font-extrabold text-primary-dark mb-6 border-b-4 border-primary-dark pb-3">
Daftar Rekam Medis Hewan
</h2>

    @if ($rekamMedis->isEmpty())
        <div class="text-center bg-gray-50 p-8 rounded-xl shadow-inner mt-4">
            <p class="text-xl text-gray-500 font-medium">📋 Belum ada riwayat rekam medis yang tercatat.</p>
        </div>
    @else
        <div class="overflow-x-auto table-container">
            <table class="min-w-full divide-y divide-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-accent-light">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">ID Rekam Medis</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Waktu (Tanggal)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Nama Hewan</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Anamnesa</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Temuan Klinis</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-accent-dark uppercase tracking-wider">Diagnosa</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach ($rekamMedis as $rm)
                        <tr class="hover:bg-purple-50 transition duration-150 ease-in-out">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700" data-label="ID Rekam">{{ $rm->idrekam_medis }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900" data-label="Waktu">{{ $rm->created_at->format('d-m-Y H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Nama Hewan">{{ $rm->temuDokter->pet->nama ?? 'N/A' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs overflow-hidden truncate" data-label="Anamnesa">{{ $rm->anamnesa }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs overflow-hidden truncate" data-label="Temuan Klinis">{{ $rm->temuan_klinis }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500 max-w-xs overflow-hidden truncate" data-label="Diagnosa">{{ $rm->diagnosa }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>


@endsection