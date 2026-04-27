<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('customer_id');
            $table->enum('shipment_status', ['Pending', 'Shipped', 'In Transit', 'Delivered'])
                  ->default('Pending');
            $table->date('delivery_date');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('customer_id')
                  ->references('id')
                  ->on('customers')
                  ->onDelete('cascade');

            // Note: Assuming orders table exists, but we'll make it flexible
            // $table->foreign('order_id')
            //       ->references('id')
            //       ->on('orders')
            //       ->onDelete('cascade');

            // Indexes for performance
            $table->index('shipment_status');
            $table->index('delivery_date');
            $table->index(['customer_id', 'shipment_status']);
            $table->index(['delivery_date', 'shipment_status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
