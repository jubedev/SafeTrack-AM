<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\Group;
use App\Models\Workstation;
use Illuminate\Database\Seeder;

class WorkstationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Traemos todas las locaciones y grupos que ya se crearon en los seeders anteriores
        $locations = Location::all();
        $group = Group::all();

        // Validacion de seguridad por si acaso
        if ($locations->isEmpty() || $group->isEmpty()) {
            $this->command->warn('No hay locaciones o grupos disponibles para crear estaciones');
            return;
        }

        // 2. Creamos puestos de trabajo organizados por grupos
        foreach ($groups as $group) {

            // Para cada grupo (area/campana), crearemos 15 puestos de trabajio
            for ($i = 1; $i <= 15; $i++) {
                Workstation::factory()->create([
                    // Forzamos a que use un codigo limpio y secuencial
                    'code' => 'WS-' . strtoupper(substr($group->name, 0, 3)) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),

                    'group_id' => $group->id,

                    // Le asignamos una sede aleatoria de las que ya existen
                    'location_id' => $locations->random()->id,
                    'status' => 'active'
                ]);
            }
        }
    }
}
