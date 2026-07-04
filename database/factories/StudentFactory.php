<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'class' => $this->faker->randomElement(['10th', '9th', 'BSCS', 'BBA', 'A-Level', 'O-Level']),
            'roll_no' => $this->faker->unique()->numberBetween(10000, 999999), // Unique roll number
            'contact' => $this->faker->unique()->numerify('##########'), // 10-digit number for contact, purely numeric as per integer type
        ];
    }
}

