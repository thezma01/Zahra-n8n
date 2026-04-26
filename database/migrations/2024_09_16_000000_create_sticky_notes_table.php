<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStickyNotesTable extends Migration
{
    public function up()
    {
        Schema::create('sticky_notes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size');
            $table->string('shape');
            $table->string('color');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sticky_notes');
    }
}
