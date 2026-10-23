<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\Company;
use App\Models\User;
use App\Models\Workstation;
use Illuminate\Database\Seeder;

class AssetAssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $demo = Company::query()->where('nit', '901234567-8')->firstOrFail();

        if (AssetAssignment::query()->where('company_id', $demo->getKey())->exists()) {
            return;
        }

        $technician = User::query()->where('email', 'tecnico@safetrack.test')->firstOrFail();
        $ana = User::query()->where('email', 'ana.perez@safetrack.test')->firstOrFail();
        $workstation = Workstation::query()
            ->where('company_id', $demo->getKey())
            ->where('operation_name', 'Mercado Libre')
            ->where('station_number', 'PUESTO-012')
            ->firstOrFail();

        $assignedLaptop = Asset::query()->where('asset_tag', 'AST-10001')->firstOrFail();
        $assignedMonitor = Asset::query()->where('asset_tag', 'AST-10002')->firstOrFail();
        $returnedKeyboard = Asset::query()->where('asset_tag', 'AST-10005')->firstOrFail();

        AssetAssignment::query()->create([
            'company_id' => $demo->getKey(),
            'asset_id' => $assignedLaptop->getKey(),
            'employee_id' => $ana->getKey(),
            'workstation_id' => null,
            'assigned_by_id' => $technician->getKey(),
            'status' => 'activo',
            'notes_on_delivery' => 'Entrega en mesa 4',
            'assigned_at' => now()->subDays(12),
            'returned_at' => null,
        ]);

        AssetAssignment::query()->create([
            'company_id' => $demo->getKey(),
            'asset_id' => $assignedMonitor->getKey(),
            'employee_id' => null,
            'workstation_id' => $workstation->getKey(),
            'assigned_by_id' => $technician->getKey(),
            'status' => 'activo',
            'notes_on_delivery' => 'Monitor fijo del puesto Mercado Libre 012',
            'assigned_at' => now()->subDays(20),
            'returned_at' => null,
        ]);

        AssetAssignment::query()->create([
            'company_id' => $demo->getKey(),
            'asset_id' => $returnedKeyboard->getKey(),
            'employee_id' => $ana->getKey(),
            'workstation_id' => null,
            'assigned_by_id' => $technician->getKey(),
            'status' => 'devuelto',
            'notes_on_delivery' => 'Préstamo temporal',
            'notes_on_return' => 'Devuelto a bodega en buen estado',
            'assigned_at' => now()->subDays(40),
            'returned_at' => now()->subDays(5),
        ]);
    }
}
