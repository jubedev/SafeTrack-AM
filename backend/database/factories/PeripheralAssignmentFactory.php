<?php

namespace Database\Factories;

use App\Models\PeripheralAssignment;
use App\Models\PeripheralType;
use App\Models\Workstation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PeripheralAssignment>
 */
class PeripheralAssignmentFactory extends Factory
{
    protected $model = PeripheralAssignment::class;

    public function definition(): array
    {
        return [
            'peripheral_type_id' => PeripheralType::factory(),
            'workstation_id' => Workstation::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'status' => 'active',
            'assigned_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
