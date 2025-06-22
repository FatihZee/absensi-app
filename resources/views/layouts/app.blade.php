<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pegawai BUMN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #0d6efd;
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #0b5ed7;
            display: block;
            padding-left: 1rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        {{-- Sidebar --}}
        <div class="sidebar p-3" style="width: 220px;">
            <h5 class="mb-4">Absensi BUMN</h5>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a href="{{ route('dashboard') }}">🏠 Dashboard</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('employees.index') }}">👥 Pegawai</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('attendance.today') }}">📅 Absensi Hari Ini</a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#">📊 Laporan</a>
                </li>
            </ul>
        </div>

        {{-- Main Content --}}
        <div class="flex-grow-1">
            {{-- Navbar --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
                <div class="container-fluid">
                    <span class="navbar-text">
                        Selamat datang, {{ session('employee')->name ?? '-' }}
                    </span>
                    <form action="{{ route('logout') }}" method="POST" class="ms-auto">
                        @csrf
                        <button class="btn btn-sm btn-outline-danger">Logout</button>
                    </form>
                </div>
            </nav>

            {{-- Page Content --}}
            <div class="container-fluid py-4">
                {{-- Flash Messages --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')
</body>
</html>
