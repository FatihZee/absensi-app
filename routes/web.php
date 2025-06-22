<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/absensi', [AttendanceController::class, 'showScanForm'])->name('attendance.scan');
Route::post('/absensi/check', [AttendanceController::class, 'checkQrCode'])->name('attendance.check');
Route::post('/absensi/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/absensi/hari-ini', [AttendanceController::class, 'today'])->name('attendance.today');

Route::middleware('auth.custom')->group(function () {
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
    Route::resource('employees', \App\Http\Controllers\EmployeeController::class);
    Route::get('employees/{employee}/qr', [EmployeeController::class, 'show'])->name('employees.qr');
});