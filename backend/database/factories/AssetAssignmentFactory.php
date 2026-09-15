<?php

namespace Database\Factories;

use App\Models\Asset;
use App\Models\AssetAssignment;
use App\Models\Company;
use App\Models\User;
use App\Models\Workstation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<AssetAssignment>
 */
class AssetAssignmentFactory extends Factory
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
            'employee_id' => fn (array $attributes) => User::factory()
                ->for(Company::findOrFail($attributes['company_id']))
                ->create()
                ->getKey(),
            'workstation_id' => null,
            'assigned_by_id' => fn (array $attributes) => User::factory()
                ->for(Company::findOrFail($attributes['company_id']))
                ->create()
                ->getKey(),
            'status' => 'activo',
            'notes_on_delivery' => fake()->optional()->sentence(),
            'notes_on_return' => null,
            'signature_path' => null,
            'assigned_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'returned_at' => null,
        ];
    }

    public function forCompany(Company $company): static
    {
        return $this->state(fn () => [
            'company_id' => $company->getKey(),
            'asset_id' => Asset::factory()->for($company)->create()->getKey(),
            'employee_id' => User::factory()->for($company)->create()->getKey(),
            'assigned_by_id' => User::factory()->for($company)->create()->getKey(),
        ]);
    }

    /**
     * Estado para asignaciones a puestos de trabajo (islas/operaciones)
     */
    public function forWorkstation(): static
    {
        return $this->state(fn (array $attributes) => [
            'employee_id' => null,
            'workstation_id' => Workstation::factory()->for(Company::findOrFail($attributes['company_id']))->create()->getKey(),
        ]);
    }

    /**
     * Estado para simular un activo devuelto a inventario
     */
    public function returned(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'devuelto',
            'notes_on_return' => fake()->sentence(),
            'returned_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ]);
    }
}