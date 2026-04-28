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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 100)->index();
            $table->enum('shipment_status', ['Pending', 'In Transit', 'Delivered', 'Cancelled'])
                  ->default('Pending')
                  ->index();
            $table->date('delivery_date')->index();
            $table->timestamps();

            // Add indexes for better query performance
            $table->index(['shipment_status', 'delivery_date']);
            $table->index(['created_at', 'shipment_status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
