@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-8 px-4 md:px-0">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Pegawai</h2>

    <form action="{{ route('employees.store') }}" method="POST" class="space-y-5 bg-white p-6 rounded-xl shadow border border-gray-200">
        @csrf

        <div>
            <label for="name" class="block text-gray-700 font-medium mb-1">Nama</label>
            <input type="text" name="name" id="name" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
            <input type="email" name="email" id="email" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
        </div>
        
        <div>
            <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
            <input type="password" name="password" id="password" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-500 focus:outline-none">
        </div>

        <div>
            <label for="division_id" class="block text-gray-700 font-medium mb-1">Divisi</label>
            <select name="division_id" id="division_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:ring focus:ring-blue-500 focus:outline-none">
                <option value="">-- Pilih Divisi --</option>
                @foreach($divisions as $division)
                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="position_id" class="block text-gray-700 font-medium mb-1">Jabatan</label>
            <select name="position_id" id="position_id" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:ring focus:ring-blue-500 focus:outline-none">
                <option value="">-- Pilih Jabatan --</option>
                @foreach($positions as $position)
                    <option value="{{ $position->id }}">{{ $position->title }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="role" class="block text-gray-700 font-medium mb-1">Role</label>
            <select name="role" id="role" required
                class="w-full px-4 py-2 border border-gray-300 rounded-md bg-white focus:ring focus:ring-blue-500 focus:outline-none">
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="employee">Employee</option>
            </select>
        </div>

        <div>
            <label class="block text-gray-700 font-medium mb-2">Status</label>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" name="is_active" value="1" checked class="text-blue-600">
                    <span class="ml-2 text-gray-700">Aktif</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" name="is_active" value="0" class="text-blue-600">
                    <span class="ml-2 text-gray-700">Nonaktif</span>
                </label>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4">
            <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-md transition">
                Simpan
            </button>
            <a href="{{ route('employees.index') }}"
                class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium py-2 px-4 rounded-md transition">
                Kembali
            </a>
        </div>
    </form>
</div>
@endsection
