<?php

namespace Tests\Feature;

use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_employees(): void
    {
        Employee::create([
            'name' => 'Alice Smith',
            'email' => 'alice@example.com',
            'salary' => 50000.00,
            'contact' => '+1234567890',
        ]);

        $response = $this->getJson('/api/employees');

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Employees retrieved successfully',
            ])
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment([
                'name' => 'Alice Smith',
                'email' => 'alice@example.com',
            ]);
    }

    public function test_can_create_employee(): void
    {
        $payload = [
            'name' => 'Bob Jones',
            'email' => 'bob@example.com',
            'salary' => 60000.50,
            'contact' => '+9876543210',
        ];

        $response = $this->postJson('/api/employees', $payload);

        $response->assertStatus(201)
            ->assertJson([
                'status' => true,
                'message' => 'Employee created successfully',
                'data' => [
                    'name' => 'Bob Jones',
                    'email' => 'bob@example.com',
                    'salary' => '60000.50',
                    'contact' => '+9876543210',
                ],
            ]);

        $this->assertDatabaseHas('employees', [
            'email' => 'bob@example.com',
        ]);
    }

    public function test_can_show_employee(): void
    {
        $employee = Employee::create([
            'name' => 'Charlie Brown',
            'email' => 'charlie@example.com',
            'salary' => 45000.00,
            'contact' => '+1122334455',
        ]);

        $response = $this->getJson("/api/employees/{$employee->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Employee retrieved successfully',
                'data' => [
                    'id' => $employee->id,
                    'name' => 'Charlie Brown',
                    'email' => 'charlie@example.com',
                ],
            ]);
    }

    public function test_can_update_employee(): void
    {
        $employee = Employee::create([
            'name' => 'David Miller',
            'email' => 'david@example.com',
            'salary' => 55000.00,
            'contact' => '+5544332211',
        ]);

        $payload = [
            'name' => 'David Miller Updated',
            'salary' => 62000.00,
        ];

        $response = $this->putJson("/api/employees/{$employee->id}", $payload);

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Employee updated successfully',
                'data' => [
                    'id' => $employee->id,
                    'name' => 'David Miller Updated',
                    'email' => 'david@example.com',
                    'salary' => '62000.00',
                ],
            ]);

        $this->assertDatabaseHas('employees', [
            'id' => $employee->id,
            'name' => 'David Miller Updated',
        ]);
    }

    public function test_can_delete_employee(): void
    {
        $employee = Employee::create([
            'name' => 'Eve Adams',
            'email' => 'eve@example.com',
            'salary' => 70000.00,
            'contact' => '+9988776655',
        ]);

        $response = $this->deleteJson("/api/employees/{$employee->id}");

        $response->assertStatus(200)
            ->assertJson([
                'status' => true,
                'message' => 'Employee deleted successfully',
            ]);

        $this->assertDatabaseMissing('employees', [
            'id' => $employee->id,
        ]);
    }
}
