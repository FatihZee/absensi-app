@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">QR Code Pegawai</h2>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <h5 class="text-lg font-medium text-gray-700 mb-1">Nama: {{ $employee->name }}</h5>
        <p class="text-gray-600 mb-4">Email: {{ $employee->email }}</p>

        <div class="my-6 flex justify-center">
            {!! QrCode::size(250)->generate($employee->qr_code) !!}
        </div>

        <p class="text-center text-gray-500 text-sm">Scan QR ini untuk melakukan absensi</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('employees.index') }}"
           class="inline-block bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-md transition">
            ← Kembali
        </a>
    </div>
</div>
@endsection
