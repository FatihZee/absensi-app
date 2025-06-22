@extends('layouts.app')

@section('content')
<h2>Daftar Absensi Hari Ini ({{ $today }})</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($employees as $e)
            @php
                $absen = $e->attendances->first();
            @endphp
            <tr>
                <td>{{ $e->name }}</td>
                <td>{{ $e->position }}</td>
                <td>{{ $absen?->check_in_time ? \Carbon\Carbon::parse($absen->check_in_time)->format('H:i') : '-' }}</td>
                <td>{{ $absen?->check_out_time ? \Carbon\Carbon::parse($absen->check_out_time)->format('H:i') : '-' }}</td>
                <td>
                    @if(!$absen)
                        <span class="badge bg-secondary">Belum Absen</span>
                    @elseif(!$absen->check_out_time)
                        <span class="badge bg-warning text-dark">Sudah Check-in</span>
                    @else
                        <span class="badge bg-success">Lengkap</span>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
