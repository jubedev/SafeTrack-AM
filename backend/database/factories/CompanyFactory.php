<?php

namespace Database\Factories;

use App\Enums\CompanyStatus;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'nit' => fake()->numerify('900######-#'),
            'address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'status' => fake()->randomElement([CompanyStatus::Activo, CompanyStatus::Inactivo]),
        ];
    }

    /**
     * Estado para forzar que la empresa esté activa
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => CompanyStatus::Activo,
        ]);
    }
}