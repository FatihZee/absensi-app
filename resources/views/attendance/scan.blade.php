@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto px-4 py-10">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Memproses QR untuk Absensi...</h2>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <form id="auto-form" method="POST" action="{{ route('attendance.check') }}">
        @csrf
        <input type="hidden" name="qr_code" value="{{ session('employee')->qr_code }}">
    </form>

    <script>
        document.getElementById('auto-form').submit();
    </script>
</div>
@endsection
