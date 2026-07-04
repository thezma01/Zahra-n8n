<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key, auto-incrementing ID for the record
            $table->string('order_id')->nullable()->unique(); // Custom order identifier, nullable and unique
            $table->foreignId('product_id')->constrained(); // Foreign key to the 'products' table. This assumes the 'products' table and its 'id' column exist.
            $table->string('customer_name'); // Customer's name, as a simple text field
            $table->text('order_summary'); // Brief summary of the order
            $table->date('date'); // Date of the order
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
