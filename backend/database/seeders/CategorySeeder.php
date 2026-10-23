<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $companies = Company::query()
            ->whereIn('nit', ['901234567-8', '800987654-1'])
            ->get();

        $catalog = [
            ['name' => 'Laptops', 'description' => 'Portátiles de operación y soporte'],
            ['name' => 'Monitores', 'description' => 'Pantallas de puesto y sala'],
            ['name' => 'Periféricos', 'description' => 'Teclados, mouse y docks'],
            ['name' => 'Redes y Conectividad', 'description' => 'Switches, APs y teléfonos IP'],
        ];

        foreach ($companies as $company) {
            foreach ($catalog as $category) {
                Category::query()->firstOrCreate(
                    [
                        'company_id' => $company->getKey(),
                        'name' => $category['name'],
                    ],
                    [
                        'description' => $category['description'],
                    ]
                );
            }
        }
    }
}
