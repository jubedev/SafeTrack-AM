<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $demo = Company::query()->where('nit', '901234567-8')->firstOrFail();
        $andina = Company::query()->where('nit', '800987654-1')->firstOrFail();

        $users = [
            [
                'company_id' => $demo->getKey(),
                'document_number' => '1010000001',
                'first_name' => 'Laura',
                'last_name' => 'Gómez',
                'email' => 'admin@safetrack.test',
                'phone' => '+57 300 111 0001',
                'password' => 'password',
                'role' => UserRole::Admin,
                'status' => UserStatus::Activo,
                'area' => 'IT Support',
                'position' => 'Coordinadora de Infraestructura',
            ],
            [
                'company_id' => $demo->getKey(),
                'document_number' => '1010000002',
                'first_name' => 'Carla',
                'last_name' => 'Ruiz',
                'email' => 'tecnico@safetrack.test',
                'phone' => '+57 300 111 0002',
                'password' => 'password',
                'role' => UserRole::Tecnico,
                'status' => UserStatus::Activo,
                'area' => 'IT Support',
                'position' => 'Analista de Soporte TI',
            ],
            [
                'company_id' => $demo->getKey(),
                'document_number' => '1010000003',
                'first_name' => 'Ana',
                'last_name' => 'Pérez',
                'email' => 'ana.perez@safetrack.test',
                'phone' => '+57 300 111 0003',
                'password' => 'password',
                'role' => UserRole::Empleado,
                'status' => UserStatus::Activo,
                'area' => 'Operaciones',
                'position' => 'Agente CSR',
            ],
            [
                'company_id' => $demo->getKey(),
                'document_number' => '1010000004',
                'first_name' => 'Bruno',
                'last_name' => 'Díaz',
                'email' => 'bruno.diaz@safetrack.test',
                'phone' => '+57 300 111 0004',
                'password' => 'password',
                'role' => UserRole::Empleado,
                'status' => UserStatus::Activo,
                'area' => 'Operaciones',
                'position' => 'Team Leader',
            ],
            [
                'company_id' => $andina->getKey(),
                'document_number' => '2020000001',
                'first_name' => 'Mario',
                'last_name' => 'Castaño',
                'email' => 'admin@andina.test',
                'phone' => '+57 300 222 0001',
                'password' => 'password',
                'role' => UserRole::Admin,
                'status' => UserStatus::Activo,
                'area' => 'IT Support',
                'position' => 'Administrador de Activos',
            ],
        ];

        foreach ($users as $user) {
            User::query()->firstOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
