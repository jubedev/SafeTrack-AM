<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Location::create([
            'name' => 'Sede Connecta - Calle 26',
            'city' => 'Bogota',
            'description' => 'Operacion principal y servidores centrales',
            'address' => 'Calle 26 # 123-45',
        ]);

        Location::create([
            'name' => 'Sede Centro - Av. El Dorado',
            'city' => 'Bogota',
            'description' => 'Campanas de soporte y atencion al cliente',
            'address' => 'Av. El Dorado # 123-45',
        ]);

        Location::factory(2)->create();
    }
}
