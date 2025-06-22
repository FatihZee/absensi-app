<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pegawai BUMN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-blue-50 via-purple-50 to-pink-50">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-gradient-to-b from-blue-600 to-purple-700 shadow-xl min-h-screen px-6 py-6">
            <h1 class="text-2xl font-bold text-white mb-8">Absensi BUMN</h1>
            <nav class="space-y-3">
                <a href="{{ route('dashboard') }}" class="block py-3 px-4 rounded-lg text-blue-100 hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200">
                    🏠 Dashboard
                </a>
                <a href="{{ route('employees.index') }}" class="block py-3 px-4 rounded-lg text-blue-100 hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200">
                    👥 Pegawai
                </a>
                <a href="{{ route('attendance.today') }}" class="block py-3 px-4 rounded-lg text-blue-100 hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200">
                    📅 Absensi Hari Ini
                </a>
                <a href="#" class="block py-3 px-4 rounded-lg text-blue-100 hover:bg-white hover:bg-opacity-20 hover:text-white transition-all duration-200">
                    📊 Laporan
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-gradient-to-r from-white to-blue-50 shadow-lg border-b border-blue-100 px-6 py-4 flex items-center justify-between">
                <span class="text-gray-800 font-semibold text-lg">
                    Selamat datang, {{ session('employee')->name ?? '-' }}
                </span>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white px-6 py-2 rounded-full transition-all duration-200 shadow-lg hover:shadow-xl">
                        Logout
                    </button>
                </form>
            </header>

            <!-- Page Content -->
            <section class="flex-1 p-6 overflow-auto">
                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 p-4 bg-gradient-to-r from-green-100 to-emerald-100 border border-green-300 text-green-800 rounded-xl shadow-md">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session('error'))
                    <div class="mb-6 p-4 bg-gradient-to-r from-red-100 to-pink-100 border border-red-300 text-red-800 rounded-xl shadow-md">
                        {{ session('error') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="mb-6 p-4 bg-gradient-to-r from-red-100 to-pink-100 border border-red-300 text-red-800 rounded-xl shadow-md">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </section>
        </main>
    </div>
    @stack('scripts')
</body>
</html>