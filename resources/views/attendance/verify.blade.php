@extends('layouts.app')

@section('content')
<div class="w-full px-4 md:px-8">
    <h2 class="text-2xl font-semibold mb-6 text-gray-800">Verifikasi Absensi</h2>

    <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
        <div class="mb-4 space-y-1 text-gray-700">
            <p><strong>Nama:</strong> {{ $employee->name }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
        </div>

        @php
            $today = \Carbon\Carbon::now()->toDateString();
            $attendance = $employee->attendances()->where('date', $today)->first();
        @endphp

        @if(!$attendance || !$attendance->check_in_time)
            <div class="mb-4 p-4 bg-blue-100 border border-blue-300 text-blue-800 rounded">
                Status: Belum Check-in
            </div>
        @elseif(!$attendance->check_out_time)
            <div class="mb-4 p-4 bg-yellow-100 border border-yellow-300 text-yellow-800 rounded">
                Status: Sudah Check-in, Belum Check-out
            </div>
        @else
            <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
                Sudah Check-in dan Check-out Hari Ini
            </div>
        @endif

        <!-- Kamera -->
        <div class="my-6 flex flex-col items-center gap-4">
            <video id="video" width="320" height="240" autoplay class="rounded shadow-sm border"></video>
            <canvas id="canvas" width="320" height="240" class="hidden border rounded shadow-sm"></canvas>
            <button type="button" onclick="initCamera()" class="text-sm text-blue-600 hover:underline">
                🔄 Refresh Kamera
            </button>
        </div>

        <!-- Form Absensi -->
        <form method="POST" action="{{ route('attendance.store') }}" onsubmit="return handleSubmit()" class="space-y-4">
            @csrf
            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
            <input type="hidden" name="photo" id="photo">

            <div class="flex flex-col md:flex-row gap-4">
                <button type="button" onclick="capture()" class="bg-gray-700 hover:bg-gray-800 text-white px-6 py-2 rounded-md transition">
                    📸 Ambil Foto
                </button>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md transition">
                    ✅ Simpan Absensi
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script>
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const photoInput = document.getElementById('photo');
    const ctx = canvas.getContext('2d');

    let stream = null;

    async function initCamera() {
        try {
            if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
                throw new Error("Kamera hanya dapat diakses melalui HTTPS atau localhost.");
            }

            if (stream) {
                stream.getTracks().forEach(track => track.stop()); // matikan stream lama
            }

            stream = await navigator.mediaDevices.getUserMedia({ video: true });
            video.srcObject = stream;
        } catch (err) {
            alert("Gagal akses kamera: " + err.message);
        }
    }

    function capture() {
        if (!stream) {
            alert("Kamera belum aktif.");
            return;
        }

        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        canvas.classList.remove('hidden');
        photoInput.value = canvas.toDataURL('image/png');
    }

    function handleSubmit() {
        if (!photoInput.value) {
            alert('Silakan ambil foto terlebih dahulu.');
            return false;
        }
        return true;
    }

    window.addEventListener('DOMContentLoaded', initCamera);
</script>
@endsection
