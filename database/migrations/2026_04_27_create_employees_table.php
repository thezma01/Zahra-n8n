<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for creating employees table
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->index();
            $table->string('email')->unique()->index();
            $table->string('contact', 20)->index();
            $table->decimal('salary', 8, 2)->unsigned()->index();
            $table->timestamps();

            // Add composite index for common search patterns
            $table->index(['name', 'email'], 'employees_name_email_index');
            $table->index(['salary', 'created_at'], 'employees_salary_created_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
