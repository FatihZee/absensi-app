@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Daftar Pegawai</h2>
    <a href="{{ route('employees.create') }}" class="btn btn-primary mb-3">Tambah Pegawai</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $e)
                <tr>
                    <td>{{ $e->name }}</td>
                    <td>{{ $e->email }}</td>
                    <td>{{ $e->division->name ?? '-' }}</td>
                    <td>{{ $e->position->title ?? '-' }}</td>
                    <td>{{ $e->is_active ? 'Aktif' : 'Nonaktif' }}</td>
                    <td>
                        <a href="{{ route('employees.qr', $e->id) }}" class="btn btn-sm btn-info">QR</a>
                        <a href="{{ route('employees.edit', $e->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('employees.destroy', $e->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
