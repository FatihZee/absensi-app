@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Tambah Pegawai</h2>

    <form action="{{ route('employees.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="division_id" class="form-label">Divisi</label>
            <select name="division_id" class="form-control" required>
                <option value="">-- Pilih Divisi --</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="position_id" class="form-label">Jabatan</label>
            <select name="position_id" class="form-control" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label><br>
            <label><input type="radio" name="is_active" value="1" checked> Aktif</label>
            <label class="ms-3"><input type="radio" name="is_active" value="0"> Nonaktif</label>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('employees.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
