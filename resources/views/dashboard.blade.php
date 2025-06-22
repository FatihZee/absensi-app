@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2>Selamat datang, {{ session('employee')->name }}</h2>
        <p>Email: {{ session('employee')->email }}</p>

        <a href="{{ route('attendance.scan') }}" class="btn btn-primary mt-3">📸 Mulai Absensi</a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-danger mt-2">Logout</button>
        </form>
    </div>
@endsection
