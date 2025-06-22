<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Division;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with(['division', 'position'])->latest()->get();
        return view('employees.index', compact('employees'));
    }

    public function create()
    {
        $divisions = Division::all();
        $positions = Position::all();
        return view('employees.create', compact('divisions', 'positions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees',
            'password' => 'required|min:6',
            'division_id' => 'required|exists:divisions,id',
            'position_id' => 'required|exists:positions,id',
            'role' => 'required|in:admin,employee',
            'is_active' => 'required|boolean',
        ]);

        Employee::create([
            'id' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'qr_code' => Str::uuid(),
            'division_id' => $request->division_id,
            'position_id' => $request->position_id,
            'role' => $request->role,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil ditambahkan.');
    }

    public function edit(Employee $employee)
    {
        $divisions = Division::all();
        $positions = Position::all();
        return view('employees.edit', compact('employee', 'divisions', 'positions'));
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:employees,email,' . $employee->id,
            'division_id' => 'required|exists:divisions,id',
            'position_id' => 'required|exists:positions,id',
            'role' => 'required|in:admin,employee',
            'is_active' => 'required|boolean',
        ]);

        $employee->update([
            'name' => $request->name,
            'email' => $request->email,
            'division_id' => $request->division_id,
            'position_id' => $request->position_id,
            'role' => $request->role,
            'is_active' => $request->is_active,
        ]);

        if ($request->filled('password')) {
            $employee->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('employees.index')->with('success', 'Data pegawai berhasil diupdate.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Pegawai berhasil dihapus.');
    }

    public function show(Employee $employee)
    {
        return view('employees.qr', compact('employee'));
    }
}