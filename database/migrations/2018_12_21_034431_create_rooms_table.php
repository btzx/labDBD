<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numero');
            $table->integer('capacidad');
            $table->boolean('disponible');
            $table->integer('precio');
            $table->date('fecha_ida');
            $table->date('fecha_vuelta');
            $table->unsignedInteger('hotel_id');
            $table->unsignedInteger('package_id')->nullable();
            $table->unsignedInteger('reservation_id');
            $table->foreign('hotel_id')->references('id')->on('hotels');
            $table->foreign('package_id')->references('id')->on('packages');
            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
