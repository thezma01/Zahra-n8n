<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure we have customers to reference
        if (Customer::count() === 0) {
            $this->command->warn('No customers found. Please seed customers first.');
            return;
        }

        $customerIds = Customer::pluck('id')->toArray();
        $statuses = Shipment::getValidShipmentStatuses();

        $shipments = [
            [
                'order_id' => 1001,
                'customer_id' => $customerIds[array_rand($customerIds)],
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
            ],
            [
                'order_id' => 1002,
                'customer_id' => $customerIds[array_rand($customerIds)],
                'shipment_status' => 'Shipped',
                'delivery_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
            ],
            [
                'order_id' => 1003,
                'customer_id' => $customerIds[array_rand($customerIds)],
                'shipment_status' => 'In Transit',
                'delivery_date' => Carbon::now()->addDay()->format('Y-m-d'),
            ],
            [
                'order_id' => 1004,
                'customer_id' => $customerIds[array_rand($customerIds)],
                'shipment_status' => 'Delivered',
                'delivery_date' => Carbon::now()->format('Y-m-d'),
            ],
            [
                'order_id' => 1005,
                'customer_id' => $customerIds[array_rand($customerIds)],
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
            ],
        ];

        foreach ($shipments as $shipment) {
            Shipment::create($shipment);
        }

        $this->command->info('Shipment seeder completed successfully.');
    }
}
