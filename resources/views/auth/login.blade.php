<!DOCTYPE html>
<html>
<head>
    <title>Login Pegawai</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow" style="min-width: 350px">
        <h4 class="mb-3 text-center">Login Pegawai</h4>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
            <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
        </form>
    </div>
</body>
</html>
