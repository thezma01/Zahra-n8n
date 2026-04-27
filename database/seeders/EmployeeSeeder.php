<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create some sample employees for testing
        
        // Create a few managers
        Employee::factory()
            ->manager()
            ->count(3)
            ->create();

        // Create some regular employees
        Employee::factory()
            ->count(15)
            ->create();

        // Create some entry level employees
        Employee::factory()
            ->entryLevel()
            ->count(5)
            ->create();

        // Create some specific test employees with known data
        Employee::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@company.com',
            'contact' => '1234567890',
            'salary' => 75000.00,
        ]);

        Employee::factory()->create([
            'name' => 'Jane Smith',
            'email' => 'jane.smith@company.com',
            'contact' => '0987654321',
            'salary' => 85000.00,
        ]);

        Employee::factory()->create([
            'name' => 'Mike Johnson',
            'email' => 'mike.johnson@company.com',
            'contact' => '5555555555',
            'salary' => 65000.00,
        ]);
    }
}
