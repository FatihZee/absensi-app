@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Daftar Pegawai</h2>

    <a href="{{ route('employees.create') }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md mb-6 transition">
        ➕ Tambah Pegawai
    </a>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 divide-y divide-gray-200 shadow-sm rounded-md bg-white">
            <thead class="bg-gray-100 text-gray-700 text-left text-sm uppercase">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Divisi</th>
                    <th class="px-4 py-3">Jabatan</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700 text-sm">
                @foreach($employees as $e)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3">{{ $e->name }}</td>
                        <td class="px-4 py-3">{{ $e->email }}</td>
                        <td class="px-4 py-3">{{ $e->division->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $e->position->title ?? '-' }}</td>
                        <td class="px-4 py-3 capitalize">{{ $e->role ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if($e->is_active)
                                <span class="inline-block bg-green-100 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">Aktif</span>
                            @else
                                <span class="inline-block bg-red-100 text-red-700 text-xs font-semibold px-3 py-1 rounded-full">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 space-x-2">
                            <a href="{{ route('employees.qr', $e->id) }}"
                               class="inline-block text-white bg-cyan-600 hover:bg-cyan-700 px-3 py-1 rounded text-sm">QR</a>
                            <a href="{{ route('employees.edit', $e->id) }}"
                               class="inline-block text-white bg-yellow-500 hover:bg-yellow-600 px-3 py-1 rounded text-sm">Edit</a>
                            <form action="{{ route('employees.destroy', $e->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Yakin hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-block text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
