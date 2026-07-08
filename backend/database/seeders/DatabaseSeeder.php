<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            LocationSeeder::class,
            DepartmentSeeder::class,
            GroupSeeder::class,
            EmployeeSeeder::class,
            WorkstationSeeder::class,

            AssetSeeder::class,
            PeripheralSeeder::class,

            AssetAssignmentSeeder::class,
            SubAssetSeeder::class,
            PeripheralAssignmentSeeder::class,
        ]);
    }
}
