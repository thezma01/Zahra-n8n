<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Employee Factory
 * 
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
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
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact' => $this->generateContact(),
            'salary' => $this->faker->randomFloat(2, 30000, 150000),
        ];
    }

    /**
     * Generate a realistic contact number
     */
    private function generateContact(): string
    {
        $formats = [
            '+1-###-###-####',
            '(###) ###-####',
            '###-###-####',
            '##########',
            '+1 ### ### ####'
        ];

        $format = $this->faker->randomElement($formats);
        
        return $this->faker->numerify($format);
    }

    /**
     * Indicate that the employee is a senior level employee.
     */
    public function senior(): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->randomFloat(2, 80000, 200000),
        ]);
    }

    /**
     * Indicate that the employee is an entry level employee.
     */
    public function junior(): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->randomFloat(2, 25000, 60000),
        ]);
    }

    /**
     * Indicate that the employee is a manager.
     */
    public function manager(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->firstName() . ' ' . $this->faker->lastName(),
            'salary' => $this->faker->randomFloat(2, 90000, 250000),
        ]);
    }

    /**
     * Create an employee with a specific salary range.
     */
    public function withSalaryRange(float $min, float $max): static
    {
        return $this->state(fn (array $attributes) => [
            'salary' => $this->faker->randomFloat(2, $min, $max),
        ]);
    }

    /**
     * Create an employee with a specific domain email.
     */
    public function withEmailDomain(string $domain): static
    {
        return $this->state(fn (array $attributes) => [
            'email' => $this->faker->unique()->userName() . '@' . $domain,
        ]);
    }
}
