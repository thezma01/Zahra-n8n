<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\Customer;
use App\Models\Order;
use Carbon\Carbon;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if we have customers and orders to create shipments for
        $customerIds = Customer::pluck('id')->toArray();
        $orderIds = Order::pluck('id')->toArray();

        if (empty($customerIds) || empty($orderIds)) {
            $this->command->warn('No customers or orders found. Please seed customers and orders first.');
            return;
        }

        $statuses = Shipment::getValidShipmentStatuses();
        $shipments = [];

        // Create sample shipments
        for ($i = 1; $i <= 50; $i++) {
            $shipments[] = [
                'order_id' => $orderIds[array_rand($orderIds)],
                'customer_id' => $customerIds[array_rand($customerIds)],
                'shipment_status' => $statuses[array_rand($statuses)],
                'delivery_date' => Carbon::now()->addDays(rand(1, 30))->format('Y-m-d'),
                'created_at' => Carbon::now()->subDays(rand(0, 10)),
                'updated_at' => Carbon::now()->subDays(rand(0, 5)),
            ];
        }

        // Insert shipments in batches for better performance
        $chunks = array_chunk($shipments, 10);
        foreach ($chunks as $chunk) {
            Shipment::insert($chunk);
        }

        $this->command->info('Shipment seeder completed successfully. Created ' . count($shipments) . ' shipments.');
    }
}
