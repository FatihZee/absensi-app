@extends('layouts.app')

@section('content')
    <h2>Verifikasi Absensi</h2>

    <div class="card p-4 shadow-sm">
        <p><strong>Nama:</strong> {{ $employee->name }}</p>
        <p><strong>Email:</strong> {{ $employee->email }}</p>

        @php
            $today = \Carbon\Carbon::now()->toDateString();
            $attendance = $employee->attendances()->where('date', $today)->first();
        @endphp

        @if(!$attendance || !$attendance->check_in_time)
            <div class="alert alert-info">Status: Belum Check-in</div>
        @elseif(!$attendance->check_out_time)
            <div class="alert alert-warning">Status: Sudah Check-in, Belum Check-out</div>
        @else
            <div class="alert alert-success">Sudah Check-in dan Check-out Hari Ini</div>
        @endif

        <div class="my-3">
            <video id="video" width="320" height="240" autoplay></video>
            <canvas id="canvas" width="320" height="240" class="d-none"></canvas>
        </div>

        <form method="POST" action="{{ route('attendance.store') }}" onsubmit="return handleSubmit()">
            @csrf
            <input type="hidden" name="employee_id" value="{{ $employee->id }}">
            <input type="hidden" name="photo" id="photo">

            <button type="button" class="btn btn-secondary" onclick="capture()">Ambil Foto</button>
            <button type="submit" class="btn btn-success">Simpan Absensi</button>
        </form>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const photoInput = document.getElementById('photo');
        const ctx = canvas.getContext('2d');

        navigator.mediaDevices.getUserMedia({ video: true })
            .then(stream => video.srcObject = stream)
            .catch(err => alert("Gagal akses kamera: " + err));

        function capture() {
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            canvas.classList.remove('d-none');
            photoInput.value = canvas.toDataURL('image/png');
        }

        function handleSubmit() {
            if (!photoInput.value) {
                alert('Silakan ambil foto terlebih dahulu.');
                return false;
            }
            return true;
        }
    </script>
@endsection
