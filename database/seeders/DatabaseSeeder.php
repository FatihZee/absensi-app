<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Position;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $division = Division::firstOrCreate(['name' => 'Teknologi Informasi']);
        $position = Position::firstOrCreate(['title' => 'Administrator']);

        $this->call(EmployeeSeeder::class);
    }
}