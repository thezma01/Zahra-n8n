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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id(); // Primary key (auto-increment)
            $table->integer('order_id');
            $table->unsignedBigInteger('customer_id');
            $table->enum('shipment_status', ['Pending', 'Shipped', 'In Transit', 'Delivered'])
                  ->default('Pending');
            $table->date('delivery_date');
            $table->timestamps(); // created_at and updated_at

            // Foreign key constraint
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            
            // Indexes for better query performance
            $table->index('order_id');
            $table->index('shipment_status');
            $table->index('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
