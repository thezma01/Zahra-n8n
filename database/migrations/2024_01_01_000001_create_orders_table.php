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
            $table->id(); // Auto-incrementing primary key
            $table->uuid('order_id')->unique()->nullable(); // Unique external order identifier, can be null
            $table->unsignedBigInteger('product_id'); // Foreign key to products table
            $table->string('customer_name');
            $table->text('order_summary')->nullable();
            $table->date('date'); // Store only date
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint (uncomment and ensure 'products' table exists if needed)
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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

