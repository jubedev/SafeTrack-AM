<?php

namespace Database\Factories;

use App\Models\AssetHistory;
use App\Models\Asset;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssetHistory>
 */
class AssetHistoryFactory extends Factory
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
            'asset_id' => fn (array $attributes) => Asset::factory()
                ->for(Company::findOrFail($attributes['company_id']))
                ->create()
                ->getKey(),
            'user_id' => fn (array $attributes) => User::factory()
                ->for(Company::findOrFail($attributes['company_id']))
                ->create()
                ->getKey(),
            'action' => fake()->randomElement([
                'created',
                'assigned_employee',
                'assigned_workstation',
                'returned',
                'status_updated',
            ]),
            'details' => fake()->optional()->sentence(),
        ];
    }

    public function forCompany(Company $company): static
    {
        return $this->state(fn () => [
            'company_id' => $company->getKey(),
            'asset_id' => Asset::factory()->for($company)->create()->getKey(),
            'user_id' => User::factory()->for($company)->create()->getKey(),
        ]);
    }
}
