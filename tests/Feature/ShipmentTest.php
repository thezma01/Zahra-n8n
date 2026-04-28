<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Shipment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    use RefreshDatabase;

    // ==================== HELPER ====================

    private function createCustomer(): Customer
    {
        return Customer::create([
            'customer_name' => 'John Doe',
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);
    }

    private function createShipment(array $overrides = []): Shipment
    {
        $customer = $this->createCustomer();

        return Shipment::create(array_merge([
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ], $overrides));
    }

    // ==================== INDEX TESTS ====================

    public function test_can_get_all_shipments()
    {
        $this->createShipment();
        $this->createShipment();

        $response = $this->getJson('/api/shipments');

        $response->assertStatus(200);
    }

    public function test_returns_empty_list_when_no_shipments()
    {
        $response = $this->getJson('/api/shipments');

        $response->assertStatus(200);
    }

    public function test_shipment_list_includes_customer()
    {
        $this->createShipment();

        $response = $this->getJson('/api/shipments');

        $response->assertStatus(200);
    }

    // ==================== STORE TESTS ====================

    public function test_can_create_shipment()
    {
        $customer = $this->createCustomer();

        $data = [
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ];

        $response = $this->postJson('/api/shipments', $data);

        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Shipment created successfully',
                 ]);

        $this->assertDatabaseHas('shipments', [
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'Pending',
        ]);
    }

    public function test_cannot_create_shipment_without_required_fields()
    {
        $response = $this->postJson('/api/shipments', []);

        $response->assertStatus(422);
    }

    public function test_cannot_create_shipment_with_invalid_status()
    {
        $customer = $this->createCustomer();

        $response = $this->postJson('/api/shipments', [
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'InvalidStatus',
            'delivery_date' => '2026-05-01',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_shipment_with_nonexistent_customer()
    {
        $response = $this->postJson('/api/shipments', [
            'order_id' => 1,
            'customer_id' => 99999,
            'shipment_status' => 'Pending',
            'delivery_date' => '2026-05-01',
        ]);

        $response->assertStatus(422);
    }

    // ==================== SHOW TESTS ====================

    public function test_can_get_single_shipment()
    {
        $shipment = $this->createShipment();

        $response = $this->getJson('/api/shipments/' . $shipment->id);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                 ]);
    }

    public function test_returns_404_for_nonexistent_shipment()
    {
        $response = $this->getJson('/api/shipments/99999');

        $response->assertStatus(404);
    }

    public function test_single_shipment_includes_customer()
    {
        $shipment = $this->createShipment();

        $response = $this->getJson('/api/shipments/' . $shipment->id);

        $response->assertStatus(200);
    }

    // ==================== UPDATE TESTS ====================

    public function test_can_update_shipment()
    {
        $shipment = $this->createShipment();
        $customer = $this->createCustomer();

        $response = $this->putJson('/api/shipments/' . $shipment->id, [
            'order_id' => 2,
            'customer_id' => $customer->id,
            'shipment_status' => 'Shipped',
            'delivery_date' => '2026-06-01',
        ]);

        $response->assertStatus(200)
                 ->assertJson([
                     'success' => true,
                     'message' => 'Shipment updated successfully',
                 ]);

        $this->assertDatabaseHas('shipments', [
            'id' => $shipment->id,
            'shipment_status' => 'Shipped',
        ]);
    }

    public function test_can_update_shipment_status_to_in_transit()
    {
        $shipment = $this->createShipment();
        $customer = $this->createCustomer();

        $response = $this->putJson('/api/shipments/' . $shipment->id, [
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'In Transit',
            'delivery_date' => '2026-06-01',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('shipments', [
            'id' => $shipment->id,
            'shipment_status' => 'In Transit',
        ]);
    }

    public function test_returns_404_when_updating_nonexistent_shipment()
    {
        $customer = $this->createCustomer();

        $response = $this->putJson('/api/shipments/99999', [
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'Shipped',
            'delivery_date' => '2026-06-01',
        ]);

        $response->assertStatus(404);
    }

    public function test_cannot_update_shipment_with_invalid_status()
    {
        $shipment = $this->createShipment();
        $customer = $this->createCustomer();

        $response = $this->putJson('/api/shipments/' . $shipment->id, [
            'order_id' => 1,
            'customer_id' => $customer->id,
            'shipment_status' => 'InvalidStatus',
            'delivery_date' => '2026-06-01',
        ]);

        $response->assertStatus(422);
    }

    // ==================== DESTROY TESTS ====================

    public function test_can_delete_shipment()
    {
        $shipment = $this->createShipment();

        $response = $this->deleteJson('/api/shipments/' . $shipment->id);

        $response->assertStatus(204);

        $this->assertDatabaseMissing('shipments', [
            'id' => $shipment->id,
        ]);
    }

    public function test_returns_404_when_deleting_nonexistent_shipment()
    {
        $response = $this->deleteJson('/api/shipments/99999');

        $response->assertStatus(404);
    }
}