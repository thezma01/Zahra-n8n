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
        Schema::create('cake_orders', function (Blueprint $table) {
            $table->id();
            $table->string('cake_name');
            $table->text('description')->nullable();
            $table->decimal('price', 8, 2);
            $table->string('flavour');
            $table->string('size');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cake_orders');
    }
};

