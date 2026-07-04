<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $shipmentStatuses = ['Pending', 'In Transit', 'Delivered', 'Cancelled'];

        return [
            'customer_name' => $this->faker->name() . ' Shipments',
            'shipment_status' => $this->faker->randomElement($shipmentStatuses),
            'delivery_date' => $this->faker->dateTimeBetween('tomorrow', '+1 year')->format('Y-m-d'),
        ];
    }
}

