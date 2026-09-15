<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'document_number' => fake()->numerify('10########'),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->phoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'Empleado',
            'status' => 'active',
            'area' => fake()->optional()->randomElement([
                'Operaciones',
                'IT Support',
                'Infraestructura',
                'Recursos Humanos',
                'Finanzas',
                'Desarrollo'
            ]),
            'position' => fake()->optional()->jobTitle(),
            'avatar_path' => null,
        ];
    }

    public function forCompany(Company $company): static
    {
        return $this->state(fn () => [
            'company_id' => $company->getKey(),
        ]);
    }

    /**
     * Estado para crear un Administrador del sistema
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'Admin',
            'area' => 'IT Support',
            'position' => 'Coordinador de Infraestructura',
        ]);
    }

    /**
     * Estado para crear un Técnico de soporte
     */
    public function technician(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'Tecnico',
            'area' => 'IT Support',
            'position' => 'Analista de Soporte TI',
        ]);
    }
}