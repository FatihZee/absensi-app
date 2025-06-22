<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $employee = Employee::where('email', $credentials['email'])->first();

        if (!$employee || !Hash::check($credentials['password'], $employee->password)) {
            return back()->withErrors(['email' => 'Email atau password salah.'])->withInput();
        }

        if (!$employee->is_active) {
            return back()->withErrors(['email' => 'Akun tidak aktif.'])->withInput();
        }

        $request->session()->put('employee', $employee);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $request->session()->forget('employee');
        return redirect()->route('login')->with('success', 'Berhasil logout.');
    }
}