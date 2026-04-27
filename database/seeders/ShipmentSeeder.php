<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shipment;
use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Clear existing shipments
        Shipment::truncate();

        // Get existing customers or create some if none exist
        $customers = Customer::all();
        
        if ($customers->isEmpty()) {
            // Create some customers first
            $customers = collect([
                Customer::create([
                    'customer_name' => 'John Doe',
                    'shipment_status' => 'Pending',
                    'delivery_date' => Carbon::now()->addDays(5),
                ]),
                Customer::create([
                    'customer_name' => 'Jane Smith',
                    'shipment_status' => 'In Transit',
                    'delivery_date' => Carbon::now()->addDays(3),
                ]),
                Customer::create([
                    'customer_name' => 'Bob Johnson',
                    'shipment_status' => 'Delivered',
                    'delivery_date' => Carbon::now()->subDays(2),
                ]),
            ]);
        }

        $statuses = Shipment::getValidShipmentStatuses();

        // Create sample shipments
        $shipments = [
            [
                'order_id' => 1001,
                'customer_id' => $customers->first()->id,
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addDays(7),
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'order_id' => 1002,
                'customer_id' => $customers->skip(1)->first()?->id ?? $customers->first()->id,
                'shipment_status' => 'Shipped',
                'delivery_date' => Carbon::now()->addDays(5),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subHours(12),
            ],
            [
                'order_id' => 1003,
                'customer_id' => $customers->skip(2)->first()?->id ?? $customers->first()->id,
                'shipment_status' => 'In Transit',
                'delivery_date' => Carbon::now()->addDays(3),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subHours(6),
            ],
            [
                'order_id' => 1004,
                'customer_id' => $customers->first()->id,
                'shipment_status' => 'Delivered',
                'delivery_date' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'order_id' => 1005,
                'customer_id' => $customers->skip(1)->first()?->id ?? $customers->first()->id,
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addDays(10),
                'created_at' => Carbon::now()->subHours(4),
                'updated_at' => Carbon::now()->subHours(4),
            ],
        ];

        // Generate additional random shipments
        for ($i = 6; $i <= 20; $i++) {
            $randomCustomer = $customers->random();
            $randomStatus = $statuses[array_rand($statuses)];
            
            // Adjust delivery date based on status
            $deliveryDate = match($randomStatus) {
                'Pending' => Carbon::now()->addDays(rand(1, 14)),
                'Shipped' => Carbon::now()->addDays(rand(1, 10)),
                'In Transit' => Carbon::now()->addDays(rand(1, 7)),
                'Delivered' => Carbon::now()->subDays(rand(1, 30)),
                default => Carbon::now()->addDays(rand(1, 7)),
            };

            $createdAt = Carbon::now()->subDays(rand(1, 10));

            $shipments[] = [
                'order_id' => 1000 + $i,
                'customer_id' => $randomCustomer->id,
                'shipment_status' => $randomStatus,
                'delivery_date' => $deliveryDate,
                'created_at' => $createdAt,
                'updated_at' => $createdAt->copy()->addHours(rand(1, 48)),
            ];
        }

        // Insert all shipments at once for better performance
        DB::table('shipments')->insert($shipments);

        $this->command->info('Created ' . count($shipments) . ' shipment records');
    }
}
