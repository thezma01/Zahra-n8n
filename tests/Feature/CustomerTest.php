<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    // ==================== INDEX TESTS ====================

    public function test_can_get_all_customers()
    {
        Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);

        $response = $this->getJson('/api/customers');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customers retrieved successfully',
                 ]);
    }

    public function test_can_filter_customers_by_shipment_status()
    {
        Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);

        Customer::create([
            'customer_name' => 'Jane Doe',
            'shipment_status' => 'Delivered',
            'delivery_date' => '2026-05-02',
        ]);

        $response = $this->getJson('/api/customers?shipment_status=Pending');

        $response->assertStatus(200)
                 ->assertJson(['success' => true]);
    }

    // ==================== STORE TESTS ====================

    public function test_can_create_customer()
    {
        $data = [
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ];

        $response = $this->postJson('/api/customers', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer created successfully',
                 ]);

        $this->assertDatabaseHas('customers', [
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
        ]);
    }

    public function test_cannot_create_customer_without_required_fields()
    {
        $response = $this->postJson('/api/customers', []);

        $response->assertStatus(422); // Validation error
    }

    // ==================== SHOW TESTS ====================

    public function test_can_get_single_customer()
    {
        $customer = Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);

        $response = $this->getJson('/api/customers/' . $customer->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer retrieved successfully',
                 ]);
    }

    public function test_returns_404_for_nonexistent_customer()
    {
        $response = $this->getJson('/api/customers/99999');

        $response->assertStatus(404)
                 ->assertJson([
                     'success' => false,
                     'message' => 'Customer not found',
                 ]);
    }

    // ==================== UPDATE TESTS ====================

    public function test_can_update_customer()
    {
        $customer = Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);

        $response = $this->putJson('/api/customers/' . $customer->id, [
            'customer_name' => 'John Updated',
            'shipment_status' => 'In Transit',
            'delivery_date' => '2026-05-10',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer updated successfully',
                 ]);

        $this->assertDatabaseHas('customers', [
            'customer_name' => 'John Updated',
            'shipment_status' => 'In Transit',
        ]);
    }

    public function test_returns_404_when_updating_nonexistent_customer()
    {
        $response = $this->putJson('/api/customers/99999', [
            'customer_name' => 'John Updated',
            'shipment_status' => 'In Transit',
            'delivery_date' => '2026-05-10',
        ]);

        $response->assertStatus(404);
    }

    // ==================== DESTROY TESTS ====================

    public function test_can_delete_customer()
    {
        $customer = Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);

        $response = $this->deleteJson('/api/customers/' . $customer->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Customer deleted successfully',
                 ]);

        $this->assertDatabaseMissing('customers', [
            'id' => $customer->id,
        ]);
    }

    public function test_returns_404_when_deleting_nonexistent_customer()
    {
        $response = $this->deleteJson('/api/customers/99999');

        $response->assertStatus(404);
    }

    // ==================== SHIPMENT STATUS TESTS ====================

    public function test_can_get_shipment_statuses()
    {
        $response = $this->getJson('/api/customers/statuses');

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Shipment statuses retrieved successfully',
                 ]);
    }
}