<?php

namespace Database\Factories;

use App\Models\PeripheralType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PeripheralType>
 */
class PeripheralTypeFactory extends Factory
{
    protected $model = PeripheralType::class;

    public function definition(): array
    {
        $totalStock = $this->faker->numberBetween(10, 50);
        $availableStock = $this->faker->numberBetween(0, $totalStock);

        return [
            'name' => $this->faker->unique()->randomElement([
                'Logitech M170 Mouse',
                'Jabra Evolve2 65 Headset',
                'Dell P2422H Monitor 24"',
                'Keychron K2 Keyboard',
                'Logitech C920 Webcam',
                'Anker USB-C Hub 7-in-1',
                'Jabra Speak 510 Speakerphone',
                'Logitech MX Master 3S Mouse',
            ]),
            'brand' => $this->faker->randomElement(['Logitech', 'Jabra', 'Dell', 'Keychron', 'Anker']),
            'total_stock' => $totalStock,
            'available_stock' => $availableStock,
        ];
    }
}
