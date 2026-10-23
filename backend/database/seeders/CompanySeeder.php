<?php

namespace Database\Seeders;

use App\Enums\CompanyStatus;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        Company::query()->firstOrCreate(
            ['nit' => '901234567-8'],
            [
                'name' => 'SafeTrack Demo SAS',
                'address' => 'Calle 26 # 92-32, Bogotá',
                'phone' => '+57 601 555 0100',
                'email' => 'ops@safetrack-demo.test',
                'website' => 'https://safetrack-demo.test',
                'status' => CompanyStatus::Activo,
            ]
        );

        Company::query()->firstOrCreate(
            ['nit' => '800987654-1'],
            [
                'name' => 'Andina Controles SAS',
                'address' => 'Cra 43A # 1-50, Medellín',
                'phone' => '+57 604 555 0199',
                'email' => 'contacto@andina-controles.test',
                'website' => 'https://andina-controles.test',
                'status' => CompanyStatus::Activo,
            ]
        );
    }
}
