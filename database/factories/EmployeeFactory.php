<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact' => $this->faker->numerify('##########'), // 10 digit phone number
            'salary' => $this->faker->randomFloat(2, 30000, 150000), // Salary between 30k-150k
        ];
    }

    /**
     * Indicate that the employee is a manager with higher salary.
     */
    public function manager(): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->randomFloat(2, 80000, 250000),
        ]);
    }

    /**
     * Indicate that the employee is entry level with lower salary.
     */
    public function entryLevel(): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->randomFloat(2, 25000, 50000),
        ]);
    }

    /**
     * Indicate that the employee has a specific salary range.
     */
    public function withSalaryRange(float $min, float $max): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->randomFloat(2, $min, $max),
        ]);
    }

    /**
     * Configure the model factory for testing with a specific domain.
     */
    public function withEmailDomain(string $domain): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => $this->faker->unique()->userName() . '@' . $domain,
        ]);
    }
}
