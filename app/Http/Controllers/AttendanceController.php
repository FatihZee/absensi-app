<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\AttendanceLog;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function showScanForm()
    {
        return view('attendance.scan');
    }

    public function checkQrCode(Request $request)
    {
        $request->validate([
            'qr_code' => 'required|string',
        ]);

        $employee = Employee::where('qr_code', $request->qr_code)->first();

        if (!$employee || !$employee->is_active) {
            return back()->with('error', 'QR tidak valid atau akun tidak aktif.');
        }

        return view('attendance.verify', compact('employee'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'photo' => 'required|string',
        ]);

        $employeeId = $request->employee_id;
        $today = now()->toDateString();

        $attendance = \App\Models\Attendance::firstOrCreate(
            ['employee_id' => $employeeId, 'date' => $today],
            ['status' => 'hadir']
        );

        $folder = 'attendance_photos';
        $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $request->photo));
        $filename = \Illuminate\Support\Str::uuid() . '.png';
        \Illuminate\Support\Facades\Storage::put("public/{$folder}/$filename", $imageData);

        $now = now();

        if (!$attendance->check_in_time) {
            $attendance->update([
                'check_in_time' => $now,
                'check_in_photo' => "$folder/$filename",
            ]);

            $attendance->logs()->create([
                'action' => 'check_in',
                'timestamp' => $now,
                'log_detail' => 'Check-in otomatis',
            ]);

            return redirect()->route('attendance.scan')->with('success', 'Berhasil check-in.');
        }

        if (!$attendance->check_out_time) {
            $attendance->update([
                'check_out_time' => $now,
                'check_out_photo' => "$folder/$filename",
            ]);

            $attendance->logs()->create([
                'action' => 'check_out',
                'timestamp' => $now,
                'log_detail' => 'Check-out otomatis',
            ]);

            return redirect()->route('attendance.scan')->with('success', 'Berhasil check-out.');
        }

        return redirect()->route('attendance.scan')->with('error', 'Sudah check-in dan check-out hari ini.');
    }
    public function today()
    {
        $today = now()->toDateString();

        $employees = \App\Models\Employee::with(['attendances' => function ($q) use ($today) {
            $q->where('date', $today);
        }])->get();

        return view('attendance.today', compact('employees', 'today'));
    }
}