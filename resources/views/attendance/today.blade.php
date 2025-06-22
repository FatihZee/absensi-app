@extends('layouts.app')

@section('content')
<div class="px-4 md:px-8 py-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">
        Daftar Absensi Hari Ini ({{ $today }})
    </h2>

    <div class="overflow-x-auto bg-white rounded-xl shadow border border-gray-200">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-800 text-sm font-semibold">
                <tr>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Jabatan</th>
                    <th class="px-6 py-3">Check-in</th>
                    <th class="px-6 py-3">Check-out</th>
                    <th class="px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @foreach($employees as $e)
                    @php
                        $absen = $e->attendances->first();
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $e->position->title ?? '-' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $absen?->check_in_time ? \Carbon\Carbon::parse($absen->check_in_time)->format('H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            {{ $absen?->check_out_time ? \Carbon\Carbon::parse($absen->check_out_time)->format('H:i') : '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if(!$absen)
                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-gray-200 text-gray-700">
                                    Belum Absen
                                </span>
                            @elseif(!$absen->check_out_time)
                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                    Sudah Check-in
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">
                                    Lengkap
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
