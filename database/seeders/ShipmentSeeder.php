<?php

namespace Database\Seeders;

use App\Models\Shipment;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Ensure we have customers and orders to reference
        $customers = Customer::all();
        $orders = Order::all();

        if ($customers->isEmpty() || $orders->isEmpty()) {
            $this->command->warn('No customers or orders found. Please seed customers and orders first.');
            return;
        }

        $statuses = Shipment::getValidShipmentStatuses();
        $shipments = [];

        // Create sample shipments
        for ($i = 1; $i <= 50; $i++) {
            $deliveryDate = Carbon::now()->addDays(rand(1, 30));
            
            $shipments[] = [
                'order_id' => $orders->random()->id,
                'customer_id' => $customers->random()->id,
                'shipment_status' => $statuses[array_rand($statuses)],
                'delivery_date' => $deliveryDate->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insert shipments in chunks for better performance
        $chunks = array_chunk($shipments, 10);
        foreach ($chunks as $chunk) {
            Shipment::insert($chunk);
        }

        $this->command->info('Successfully seeded ' . count($shipments) . ' shipments.');
    }
}
