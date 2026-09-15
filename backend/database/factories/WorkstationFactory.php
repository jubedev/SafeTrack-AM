<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Workstation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Workstation>
 */
class WorkstationFactory extends Factory
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
            'operation_name' => fake()->randomElement([
                'Mercado Libre',
                'Amazon',
                'Soporte TI',
                'Operaciones Operativas',
                'Servicio al Cliente',
                'Facturación'
            ]),
            'station_number' => 'PUESTO-' . fake()->numerify('###'),
            'building_floor' => 'Piso ' . fake()->numberBetween(1, 5) . ' - Isla ' . fake()->randomLetter(),
            'status' => 'activo',
        ];
    }

    public function forCompany(Company $company): static
    {
        return $this->state(fn () => [
            'company_id' => $company->getKey(),
        ]);
    }

    /**
     * Estado para puestos en mantenimiento
     */
    public function inMaintenance(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'mantenimiento',
        ]);
    }
}