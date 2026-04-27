<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Setup method to run before each test.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Set up test data
        $this->createTestCustomers();
    }

    /**
     * Create test customers for testing.
     *
     * @return void
     */
    private function createTestCustomers(): void
    {
        Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => Carbon::now()->addDays(3)->format('Y-m-d'),
        ]);

        Customer::create([
            'customer_name' => 'Jane Smith',
            'shipment_status' => 'In Transit',
            'delivery_date' => Carbon::now()->addDays(1)->format('Y-m-d'),
        ]);

        Customer::create([
            'customer_name' => 'Bob Johnson',
            'shipment_status' => 'Delivered',
            'delivery_date' => Carbon::now()->subDays(1)->format('Y-m-d'),
        ]);
    }

    /**
     * Test getting all customers.
     *
     * @return void
     */
    public function test_can_get_all_customers(): void
    {
        $response = $this->getJson('/api/customers');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         '*' => [
                             'id',
                             'customer_name',
                             'shipment_status',
                             'delivery_date',
                             'created_at',
                             'updated_at'
                         ]
                     ],
                     'pagination' => [
                         'current_page',
                         'last_page',
                         'per_page',
                         'total',
                         'from',
                         'to'
                     ]
                 ])
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customers retrieved successfully'
                 ]);

        $this->assertCount(3, $response->json('data'));
    }

    /**
     * Test getting customers with filtering by shipment status.
     *
     * @return void
     */
    public function test_can_filter_customers_by_shipment_status(): void
    {
        $response = $this->getJson('/api/customers?shipment_status=Pending');

        $response->assertStatus(200);
        $this->assertCount(1, $response->json('data'));
        $this->assertEquals('Pending', $response->json('data.0.shipment_status'));
    }

    /**
     * Test getting customers with sorting.
     *
     * @return void
     */
    public function test_can_sort_customers(): void
    {
        $response = $this->getJson('/api/customers?sort_by=customer_name&sort_direction=asc');

        $response->assertStatus(200);
        $data = $response->json('data');
        
        $this->assertEquals('Bob Johnson', $data[0]['customer_name']);
        $this->assertEquals('Jane Smith', $data[1]['customer_name']);
        $this->assertEquals('John Doe', $data[2]['customer_name']);
    }

    /**
     * Test getting customers with pagination.
     *
     * @return void
     */
    public function test_can_paginate_customers(): void
    {
        $response = $this->getJson('/api/customers?per_page=2');

        $response->assertStatus(200);
        $this->assertCount(2, $response->json('data'));
        $this->assertEquals(2, $response->json('pagination.per_page'));
        $this->assertEquals(3, $response->json('pagination.total'));
    }

    /**
     * Test getting a single customer.
     *
     * @return void
     */
    public function test_can_get_single_customer(): void
    {
        $customer = Customer::first();
        
        $response = $this->getJson("/api/customers/{$customer->id}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'customer_name',
                         'shipment_status',
                         'delivery_date',
                         'created_at',
                         'updated_at'
                     ]
                 ])
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer retrieved successfully',
                     'data' => [
                         'id' => $customer->id,
                         'customer_name' => $customer->customer_name,
                         'shipment_status' => $customer->shipment_status,
                         'delivery_date' => $customer->delivery_date->format('Y-m-d')
                     ]
                 ]);
    }

    /**
     * Test getting non-existent customer returns 404.
     *
     * @return void
     */
    public function test_get_non_existent_customer_returns_404(): void
    {
        $response = $this->getJson('/api/customers/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Customer not found',
                     'error' => 'No customer found with the provided ID'
                 ]);
    }

    /**
     * Test creating a new customer.
     *
     * @return void
     */
    public function test_can_create_customer(): void
    {
        $customerData = [
            'customer_name' => 'New Customer',
            'shipment_status' => 'Pending',
            'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'data' => [
                         'id',
                         'customer_name',
                         'shipment_status',
                         'delivery_date',
                         'created_at',
                         'updated_at'
                     ]
                 ])
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer created successfully',
                     'data' => [
                         'customer_name' => 'New Customer',
                         'shipment_status' => 'Pending',
                         'delivery_date' => $customerData['delivery_date']
                     ]
                 ]);

        $this->assertDatabaseHas('customers', $customerData);
    }

    /**
     * Test creating customer with invalid data fails validation.
     *
     * @return void
     */
    public function test_create_customer_validation_fails(): void
    {
        $response = $this->postJson('/api/customers', []);

        $response->assertStatus(422)
                 ->assertJsonStructure([
                     'success',
                     'message',
                     'errors',
                     'valid_shipment_statuses'
                 ])
                 ->assertJson([
                     'success' => false,
                     'message' => 'Validation failed'
                 ]);

        $this->assertArrayHasKey('customer_name', $response->json('errors'));
        $this->assertArrayHasKey('shipment_status', $response->json('errors'));
        $this->assertArrayHasKey('delivery_date', $response->json('errors'));
    }

    /**
     * Test creating customer with invalid shipment status fails.
     *
     * @return void
     */
    public function test_create_customer_with_invalid_shipment_status_fails(): void
    {
        $customerData = [
            'customer_name' => 'Test Customer',
            'shipment_status' => 'Invalid Status',
            'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(422)
                 ->assertJsonPath('errors.shipment_status.0', 
                     'Shipment status must be one of: ' . implode(', ', Customer::getValidShipmentStatuses())
                 );
    }

    /**
     * Test creating customer with past delivery date fails.
     *
     * @return void
     */
    public function test_create_customer_with_past_delivery_date_fails(): void
    {
        $customerData = [
            'customer_name' => 'Test Customer',
            'shipment_status' => 'Pending',
            'delivery_date' => Carbon::now()->subDays(1)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(422)
                 ->assertJsonPath('errors.delivery_date.0', 
                     'Delivery date must be today or in the future'
                 );
    }

    /**
     * Test updating an existing customer.
     *
     * @return void
     */
    public function test_can_update_customer(): void
    {
        $customer = Customer::first();
        $updateData = [
            'customer_name' => 'Updated Customer Name',
            'shipment_status' => 'In Transit'
        ];

        $response = $this->putJson("/api/customers/{$customer->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer updated successfully',
                     'data' => [
                         'id' => $customer->id,
                         'customer_name' => 'Updated Customer Name',
                         'shipment_status' => 'In Transit'
                     ]
                 ]);

        $this->assertDatabaseHas('customers', [
            'id' => $customer->id,
            'customer_name' => 'Updated Customer Name',
            'shipment_status' => 'In Transit'
        ]);
    }

    /**
     * Test updating customer with partial data.
     *
     * @return void
     */
    public function test_can_partially_update_customer(): void
    {
        $customer = Customer::first();
        $originalName = $customer->customer_name;
        $updateData = [
            'shipment_status' => 'Delivered'
        ];

        $response = $this->putJson("/api/customers/{$customer->id}", $updateData);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer updated successfully',
                     'data' => [
                         'id' => $customer->id,
                         'customer_name' => $originalName,
                         'shipment_status' => 'Delivered'
                     ]
                 ]);
    }

    /**
     * Test updating non-existent customer returns 404.
     *
     * @return void
     */
    public function test_update_non_existent_customer_returns_404(): void
    {
        $response = $this->putJson('/api/customers/999', [
            'customer_name' => 'Test'
        ]);

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Customer not found'
                 ]);
    }

    /**
     * Test deleting a customer.
     *
     * @return void
     */
    public function test_can_delete_customer(): void
    {
        $customer = Customer::first();

        $response = $this->deleteJson("/api/customers/{$customer->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer deleted successfully',
                     'data' => null
                 ]);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id
        ]);
    }

    /**
     * Test deleting non-existent customer returns 404.
     *
     * @return void
     */
    public function test_delete_non_existent_customer_returns_404(): void
    {
        $response = $this->deleteJson('/api/customers/999');

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Customer not found'
                 ]);
    }

    /**
     * Test getting shipment statuses endpoint.
     *
     * @return void
     */
    public function test_can_get_shipment_statuses(): void
    {
        $response = $this->getJson('/api/customers-shipment-statuses');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Shipment statuses retrieved successfully',
                     'data' => Customer::getValidShipmentStatuses()
                 ]);

        $this->assertEquals(
            ['Pending', 'In Transit', 'Delivered', 'Cancelled'],
            $response->json('data')
        );
    }

    /**
     * Test customer name validation with special characters.
     *
     * @return void
     */
    public function test_customer_name_allows_valid_special_characters(): void
    {
        $customerData = [
            'customer_name' => "Mary O'Connor-Smith Jr.",
            'shipment_status' => 'Pending',
            'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('customers', [
            'customer_name' => "Mary O'Connor-Smith Jr."
        ]);
    }

    /**
     * Test customer name validation rejects invalid characters.
     *
     * @return void
     */
    public function test_customer_name_rejects_invalid_characters(): void
    {
        $customerData = [
            'customer_name' => 'Customer@123!',
            'shipment_status' => 'Pending',
            'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(422)
                 ->assertJsonPath('errors.customer_name.0', 
                     'Customer name can only contain letters, spaces, hyphens, dots, and apostrophes'
                 );
    }

    /**
     * Test customer name length validation.
     *
     * @return void
     */
    public function test_customer_name_length_validation(): void
    {
        // Test minimum length
        $customerData = [
            'customer_name' => 'A',
            'shipment_status' => 'Pending',
            'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);
        $response->assertStatus(422)
                 ->assertJsonPath('errors.customer_name.0', 'Customer name must be at least 2 characters');

        // Test maximum length
        $customerData['customer_name'] = str_repeat('A', 101);
        $response = $this->postJson('/api/customers', $customerData);
        $response->assertStatus(422)
                 ->assertJsonPath('errors.customer_name.0', 'Customer name must not exceed 100 characters');
    }

    /**
     * Test delivery date format validation.
     *
     * @return void
     */
    public function test_delivery_date_format_validation(): void
    {
        $customerData = [
            'customer_name' => 'Test Customer',
            'shipment_status' => 'Pending',
            'delivery_date' => '2024-13-01' // Invalid month
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(422);
        $this->assertArrayHasKey('delivery_date', $response->json('errors'));
    }

    /**
     * Test filtering customers by delivery date range.
     *
     * @return void
     */
    public function test_can_filter_customers_by_delivery_date_range(): void
    {
        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addWeek()->format('Y-m-d');

        $response = $this->getJson("/api/customers?delivery_date_from={$startDate}&delivery_date_to={$endDate}");

        $response->assertStatus(200);
        
        // Should return customers with delivery dates in the future
        $data = $response->json('data');
        foreach ($data as $customer) {
            $deliveryDate = Carbon::parse($customer['delivery_date']);
            $this->assertTrue($deliveryDate->between($startDate, $endDate));
        }
    }

    /**
     * Test API handles database errors gracefully.
     *
     * @return void
     */
    public function test_api_handles_database_errors_gracefully(): void
    {
        // This test would require mocking database failures
        // For now, we'll test with an invalid ID that causes a different type of error
        
        $response = $this->getJson('/api/customers/invalid-id');
        
        // Should return 500 or handle gracefully rather than exposing raw errors
        $this->assertContains($response->status(), [404, 422, 500]);
        $this->assertArrayHasKey('success', $response->json());
        $this->assertFalse($response->json('success'));
    }

    /**
     * Test trimming whitespace from input data.
     *
     * @return void
     */
    public function test_trims_whitespace_from_input(): void
    {
        $customerData = [
            'customer_name' => '  John Doe  ',
            'shipment_status' => '  Pending  ',
            'delivery_date' => Carbon::now()->addDays(5)->format('Y-m-d')
        ];

        $response = $this->postJson('/api/customers', $customerData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('customers', [
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending'
        ]);
    }
}
