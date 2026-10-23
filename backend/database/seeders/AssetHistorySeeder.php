<?php

namespace Database\Seeders;

use App\Enums\HistoryAction;
use App\Models\Asset;
use App\Models\AssetHistory;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssetHistorySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::query()->where('email', 'admin@safetrack.test')->firstOrFail();
        $technician = User::query()->where('email', 'tecnico@safetrack.test')->firstOrFail();
        $andinaAdmin = User::query()->where('email', 'admin@andina.test')->firstOrFail();

        $assets = Asset::query()
            ->whereIn('asset_tag', [
                'AST-10001',
                'AST-10002',
                'AST-10003',
                'AST-10004',
                'AST-10005',
                'AST-20001',
            ])
            ->get()
            ->keyBy('asset_tag');

        $events = [
            [
                'asset_tag' => 'AST-10001',
                'user' => $admin,
                'action' => HistoryAction::Creado,
                'details' => 'Alta de inventario ThinkPad L14',
                'created_at' => now()->subDays(60),
            ],
            [
                'asset_tag' => 'AST-10001',
                'user' => $technician,
                'action' => HistoryAction::AsignadoEmpleado,
                'details' => json_encode([
                    'employee_email' => 'ana.perez@safetrack.test',
                    'notes' => 'Entrega en mesa 4',
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now()->subDays(12),
            ],
            [
                'asset_tag' => 'AST-10002',
                'user' => $admin,
                'action' => HistoryAction::Creado,
                'details' => 'Alta de inventario Monitor LG 24"',
                'created_at' => now()->subDays(55),
            ],
            [
                'asset_tag' => 'AST-10002',
                'user' => $technician,
                'action' => HistoryAction::AsignadoUbicacion,
                'details' => json_encode([
                    'workstation' => 'Mercado Libre / PUESTO-012',
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now()->subDays(20),
            ],
            [
                'asset_tag' => 'AST-10003',
                'user' => $admin,
                'action' => HistoryAction::Creado,
                'details' => 'Alta de inventario HP EliteBook 840',
                'created_at' => now()->subDays(50),
            ],
            [
                'asset_tag' => 'AST-10004',
                'user' => $admin,
                'action' => HistoryAction::Creado,
                'details' => 'Alta de inventario Dell Latitude 5420',
                'created_at' => now()->subDays(48),
            ],
            [
                'asset_tag' => 'AST-10004',
                'user' => $technician,
                'action' => HistoryAction::AsignadoEstado,
                'details' => json_encode([
                    'from' => 'disponible',
                    'to' => 'en_mantenimiento',
                    'reason' => 'Falla de teclado',
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now()->subDays(3),
            ],
            [
                'asset_tag' => 'AST-10005',
                'user' => $admin,
                'action' => HistoryAction::Creado,
                'details' => 'Alta de inventario Teclado Logitech K120',
                'created_at' => now()->subDays(45),
            ],
            [
                'asset_tag' => 'AST-10005',
                'user' => $technician,
                'action' => HistoryAction::AsignadoEmpleado,
                'details' => json_encode([
                    'employee_email' => 'ana.perez@safetrack.test',
                    'notes' => 'Préstamo temporal',
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now()->subDays(40),
            ],
            [
                'asset_tag' => 'AST-10005',
                'user' => $technician,
                'action' => HistoryAction::Devuelto,
                'details' => json_encode([
                    'to_status' => 'disponible',
                    'notes' => 'Devuelto a bodega en buen estado',
                ], JSON_UNESCAPED_UNICODE),
                'created_at' => now()->subDays(5),
            ],
            [
                'asset_tag' => 'AST-20001',
                'user' => $andinaAdmin,
                'action' => HistoryAction::Creado,
                'details' => 'Alta de inventario tenant Andina Controles',
                'created_at' => now()->subDays(30),
            ],
        ];

        foreach ($events as $event) {
            $asset = $assets[$event['asset_tag']];

            $exists = AssetHistory::query()
                ->where('asset_id', $asset->getKey())
                ->where('action', $event['action'])
                ->where('created_at', $event['created_at'])
                ->exists();

            if ($exists) {
                continue;
            }

            $history = new AssetHistory;
            $history->forceFill([
                'company_id' => $asset->company_id,
                'asset_id' => $asset->getKey(),
                'user_id' => $event['user']->getKey(),
                'action' => $event['action'],
                'details' => $event['details'],
                'created_at' => $event['created_at'],
                'updated_at' => $event['created_at'],
            ])->save();
        }
    }
}
