<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCakeOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('cake_orders', function (Blueprint $table) {
            $table->id();
            $table->string('cake_name');
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->string('flavour');
            $table->string('size');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cake_orders');
    }
}
