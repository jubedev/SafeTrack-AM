<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Asset>
 */
class AssetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'category_id' => fn (array $attributes) => Category::factory()
                ->for(Company::findOrFail($attributes['company_id']))
                ->create()
                ->getKey(),
            'name' => fake()->randomElement([
                'ThinkPad L14',
                'Dell Latitude 5420',
                'HP EliteBook 840',
                'Monitor LG 24"',
                'Teclado Logitech K120',
                'Servidor PowerEdge R640'
            ]),
            'brand' => fake()->randomElement(['Lenovo', 'Dell', 'HP', 'LG', 'Logitech']),
            'model' => fake()->bothify('MD-####-??'),
            'serial_number' => strtoupper(fake()->bothify('SN-???#####')),
            'asset_tag' => strtoupper(fake()->bothify('AST-#####')),
            'specifications' => [
                'processor' => fake()->randomElement(['Intel Core i5 11th Gen', 'AMD Ryzen 5 PRO', 'Intel Core i7 12th Gen']),
                'ram' => fake()->randomElement(['8GB DDR4', '16GB DDR4', '32GB DDR4']),
                'storage' => fake()->randomElement(['256GB SSD', '512GB SSD NVMe', '1TB NVMe']),
            ],
            'status' => 'disponible',
            'location' => 'Bodega Principal',
            'purchase_date' => fake()->dateTimeBetween('-2 years', '-1 month')->format('Y-m-d'),
            'warranty_expiration' => fake()->dateTimeBetween('+6 months', '+3 years')->format('Y-m-d'),
            'cost' => fake()->randomFloat(2, 500000, 4500000),
        ];
    }

    public function forCompany(Company $company): static
    {
        return $this->state(fn () => [
            'company_id' => $company->getKey(),
            'category_id' => Category::factory()->for($company)->create()->getKey(),
        ]);
    }

    /**
     * Estado para activos asignados
     */
    public function assigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'asignado',
        ]);
    }

    /**
     * Estado para activos en mantenimiento
     */
    public function inMaintenance(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'en_mantenimiento',
        ]);
    }
}