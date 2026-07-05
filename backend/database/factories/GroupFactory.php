<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Group>
 */
class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        $workGroups = [
            'Frontend Development Team',
            'Cybersecurity Team',
            'Infrastructure and Servers',
            'Specialized Technical Support',
            'Data and Analytics Cell',
            'Administration and Operations',
            'UX/UI Design',
            'Quality Assurance (QA Testing)',
        ];

        return [
            'name' => $this->faker->unique()->randomElement($workGroups),
            'description' => $this->faker->sentence(6),
            'location_id' => Location::factory(),
        ];
    }
}
