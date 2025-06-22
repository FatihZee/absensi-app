@extends('layouts.app')

@section('content')
    <h2>Memproses QR untuk Absensi...</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form id="auto-form" method="POST" action="{{ route('attendance.check') }}">
        @csrf
        <input type="hidden" name="qr_code" value="{{ session('employee')->qr_code }}">
    </form>

    <script>
        document.getElementById('auto-form').submit();
    </script>
@endsection
