<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Workstation;
use Illuminate\Database\Seeder;

class WorkstationSeeder extends Seeder
{
    public function run(): void
    {
        $demo = Company::query()->where('nit', '901234567-8')->firstOrFail();

        $stations = [
            [
                'operation_name' => 'Mercado Libre',
                'station_number' => 'PUESTO-012',
                'building_floor' => 'Piso 3 - Isla A',
                'status' => 'activo',
            ],
            [
                'operation_name' => 'Amazon',
                'station_number' => 'PUESTO-021',
                'building_floor' => 'Piso 3 - Isla B',
                'status' => 'activo',
            ],
            [
                'operation_name' => 'Soporte TI',
                'station_number' => 'PUESTO-101',
                'building_floor' => 'Piso 2 - Mesa de ayuda',
                'status' => 'activo',
            ],
        ];

        foreach ($stations as $station) {
            Workstation::query()->firstOrCreate(
                [
                    'company_id' => $demo->getKey(),
                    'operation_name' => $station['operation_name'],
                    'station_number' => $station['station_number'],
                ],
                [
                    'building_floor' => $station['building_floor'],
                    'status' => $station['status'],
                ]
            );
        }
    }
}
