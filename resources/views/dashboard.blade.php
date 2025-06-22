@extends('layouts.app')

@php
    $today = now()->toDateString();
    $attendance = session('employee')->attendances()->where('date', $today)->first();

    $status = $attendance?->status;

    $statusBg = match($status) {
        'hadir' => 'bg-green-50',
        'telat' => 'bg-yellow-50',
        'izin' => 'bg-blue-50',
        'sakit' => 'bg-purple-50',
        'alpha' => 'bg-red-50',
        default => 'bg-gray-100',
    };

    $statusText = match($status) {
        'hadir' => 'text-green-600',
        'telat' => 'text-yellow-600',
        'izin' => 'text-blue-600',
        'sakit' => 'text-purple-600',
        'alpha' => 'text-red-600',
        default => 'text-gray-600',
    };

    $statusLabel = $status ? ucfirst($status) : 'Belum Absen';
@endphp

@section('content')
<div class="w-full px-4 md:px-8">
    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-2xl p-8 text-white mb-8 shadow-xl">
        <h2 class="text-3xl font-bold mb-2">Selamat datang, {{ session('employee')->name }}</h2>
        <p class="text-blue-100 text-lg">📧 {{ session('employee')->email }}</p>
    </div>

    <!-- Action Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <!-- Mulai Absensi Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-all duration-200">
            <div class="text-center">
                <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">📸</span>
                </div>
                <h3 class="text-xl font-semibold text-gray-800 mb-2">Mulai Absensi</h3>
                <p class="text-gray-600 mb-4">Scan QR Code untuk mencatat kehadiran</p>
                <a href="{{ route('attendance.scan') }}" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-200 shadow-md hover:shadow-lg inline-block">
                    📸 Mulai Absensi
                </a>
            </div>
        </div>

        <!-- Quick Stats Card -->
        <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">Status Hari Ini</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-blue-50 rounded-lg">
                    <span class="text-gray-700">🕘 Jam Masuk</span>
                    <span class="font-semibold text-blue-600">
                        {{ $attendance?->check_in_time ? \Carbon\Carbon::parse($attendance->check_in_time)->format('H:i') : '-' }}
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 bg-purple-50 rounded-lg">
                    <span class="text-gray-700">🕕 Jam Keluar</span>
                    <span class="font-semibold text-purple-600">
                        {{ $attendance?->check_out_time ? \Carbon\Carbon::parse($attendance->check_out_time)->format('H:i') : '-' }}
                    </span>
                </div>
                <div class="flex items-center justify-between p-3 {{ $statusBg }} rounded-lg">
                    <span class="text-gray-700">✅ Status</span>
                    <span class="font-semibold {{ $statusText }}">
                        {{ $statusLabel }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
