<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Location;
use App\Models\Workstation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workstation>
 */
class WorkstationFactory extends Factory
{
    protected $model = Workstation::class;

    public function definition(): array
    {
        return [
            'code' => 'WS-' . $this->faker->unique()->numerify('###'),
            'location_id' => Location::factory(),
            'group_id' => Group::factory(),
            'status' => 'active',
        ];
    }
}
