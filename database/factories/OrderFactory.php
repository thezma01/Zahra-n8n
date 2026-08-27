<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => (string) Str::uuid(), // Generate a UUID for the order_id
            'product_id' => $this->faker->numberBetween(1, 100), // Assuming product IDs between 1 and 100
            'customer_name' => $this->faker->name(),
            'order_summary' => $this->faker->sentence(),
            'date' => $this->faker->date(),
        ];
    }
}

