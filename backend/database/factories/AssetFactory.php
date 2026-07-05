<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\Category;
use App\Models\Location;
use App\Models\Workstation;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetFactory extends Factory
{
    protected $model = Asset::class;

    public function definition(): array
    {
        return [
            'internal_code' => 'ST-' . $this->faker->unique()->bothify('###??'),
            'serial_number' => $this->faker->unique()->bothify('SN-########'),
            'qr_code' => 'QR-' . $this->faker->unique()->bothify('########'),
            'brand' => $this->faker->randomElement(['Lenovo', 'Dell', 'HP']),
            'model' => $this->faker->randomElement(['ThinkPad L14', 'Latitude 5420', 'ProBook 440']),
            'status' => 'available',
            'category_id' => Category::factory(),
            'location_id' => Location::factory(),
            'workstation_id' => null,
            'specifications' => [
                'processor' => $this->faker->randomElement(['AMD Ryzen 5 7530U', 'Intel Core i5-1135G7', 'Apple M2']),
                'ram' => $this->faker->randomElement(['8GB DDR4', '16GB DDR4', '32GB DDR5']),
                'storage' => $this->faker->randomElement(['256GB NVMe SSD', '512GB NVMe SSD', '1TB NVMe SSD']),
                'os' => 'CachyOS Linux',
            ],
            'purchase_date' => $this->faker->date(),
            'warranty_expiration' => $this->faker->optional()->date(),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    public function atWorkstation(?Workstation $workstation = null): static
    {
        return $this->state(function () use ($workstation) {
            $workstation ??= Workstation::factory()->create();

            return [
                'workstation_id' => $workstation->id,
                'location_id' => $workstation->location_id,
                'status' => 'assigned',
            ];
        });
    }
}
