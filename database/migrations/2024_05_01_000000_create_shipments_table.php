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
            $table->id(); // Shipment ID (Primary key, auto-increment)
            $table->integer('order_id')->index(); // Order ID
            $table->unsignedBigInteger('customer_id')->index(); // Customer ID (Foreign/reference ID for customer)
            $table->string('shipment_status'); // Shipment Status (e.g., Pending, Shipped, In Transit, Delivered)
            $table->date('delivery_date'); // Expected Delivery Date (YYYY-MM-DD)
            $table->timestamps(); // Created_at / Updated_at
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
