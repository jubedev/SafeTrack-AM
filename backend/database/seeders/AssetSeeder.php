<?php

namespace Database\Seeders;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Workstation;

use Illuminate\Database\Seeder;

class AssetSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $locations = Location::all();
        $workstations = Workstation::all();

        // --- ESCENARIO A: Equipos asignados a puestos de trabajo ---
        foreach ($workstations as $ws) {
            // El 80% de las estaciones de trabajo tienen al menos 1 equipo asignado
            if (rand(0, 10) < 8) {
                Asset::create([
                    'workstation_id' => $ws->id,
                    'location_id' => $ws->location_id,
                    'category_id' => $categories->random()->id,
                    'status' => 'assigned',
                ]);
            }
        }

        // --- ESCENARIO B: Equipos guardados en bodega (Stock Libre) ---
        foreach ($locations as $location) {
            // Creamos 5 laptops guardadas en la bodega de cada sede
            Asset::factory(5)->create([
                'workstation_id' => null,
                'location_id' => $location->id,
                'category_id' => $categories->where('name', 'Laptop')->first()->id ?? 1,
                'status' => 'available',
            ]);
        }
    }
}
