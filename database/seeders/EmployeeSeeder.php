<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        Employee::create([
            'id' => Str::uuid(),
            'name' => 'Admin Utama',
            'email' => 'admin@bumn.co.id',
            'password' => Hash::make('password123'),
            'qr_code' => Str::uuid(),
            'division_id' => 1,
            'position_id' => 1,
            'is_active' => true,
            'role' => 'admin',
        ]);
    }
}