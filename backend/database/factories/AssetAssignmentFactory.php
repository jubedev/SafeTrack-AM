<?php

namespace Database\Factories;

use App\Models\AssetAssignment;
use App\Models\Asset;
use App\Models\Employee;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class AssetAssignmentFactory extends Factory
{
    protected $model = AssetAssignment::class;

    public function definition(): array
    {
        return [
            'asset_id' => Asset::factory(),
            'employee_id' => Employee::factory(),
            'group_id' => Group::factory(),
            'assigned_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'returned_at' => $this->faker->optional()->dateTimeBetween('-6 months', 'now'),
            'reason' => $this->faker->optional()->sentence(),
        ];
    }
}
