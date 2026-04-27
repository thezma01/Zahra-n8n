<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $customers = [
            [
                'customer_name' => 'John Smith',
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'customer_name' => 'Maria Garcia',
                'shipment_status' => 'In Transit',
                'delivery_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
                'created_at' => Carbon::now()->subHours(6),
                'updated_at' => Carbon::now()->subHours(2),
            ],
            [
                'customer_name' => 'David Johnson',
                'shipment_status' => 'Delivered',
                'delivery_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'customer_name' => 'Sarah Wilson',
                'shipment_status' => 'Cancelled',
                'delivery_date' => Carbon::now()->addDays(7)->format('Y-m-d'),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subHours(12),
            ],
            [
                'customer_name' => 'Michael Brown',
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d'),
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(3),
            ],
            [
                'customer_name' => 'Jennifer Davis',
                'shipment_status' => 'In Transit',
                'delivery_date' => Carbon::now()->addDays(2)->format('Y-m-d'),
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subHours(8),
            ],
            [
                'customer_name' => 'Robert Miller',
                'shipment_status' => 'Delivered',
                'delivery_date' => Carbon::now()->subDays(3)->format('Y-m-d'),
                'created_at' => Carbon::now()->subWeek(),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'customer_name' => 'Lisa Anderson',
                'shipment_status' => 'Pending',
                'delivery_date' => Carbon::now()->addWeek()->format('Y-m-d'),
                'created_at' => Carbon::now()->subHours(1),
                'updated_at' => Carbon::now()->subHours(1),
            ],
            [
                'customer_name' => 'James Taylor',
                'shipment_status' => 'In Transit',
                'delivery_date' => Carbon::now()->addDays(4)->format('Y-m-d'),
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subHours(4),
            ],
            [
                'customer_name' => 'Emily Thomas',
                'shipment_status' => 'Delivered',
                'delivery_date' => Carbon::now()->subDays(2)->format('Y-m-d'),
                'created_at' => Carbon::now()->subDays(6),
                'updated_at' => Carbon::now()->subDays(2),
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
