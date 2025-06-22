@extends('layouts.app')

@section('content')
<div class="container">
    <h2>QR Code Pegawai</h2>

    <div class="card shadow p-4" style="max-width: 400px">
        <h5>Nama: {{ $employee->name }}</h5>
        <p>Email: {{ $employee->email }}</p>

        <div class="my-4 text-center">
            {!! QrCode::size(250)->generate($employee->qr_code) !!}
        </div>

        <p class="text-muted text-center">Scan QR ini untuk melakukan absensi</p>
    </div>

    <a href="{{ route('employees.index') }}" class="btn btn-secondary mt-4">Kembali</a>
</div>
@endsection
