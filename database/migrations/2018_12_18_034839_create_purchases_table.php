<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('fecha');
            $table->integer('precio');
            $table->string('tipo_tarjeta');
            $table->string('numero_tarjeta');
            $table->string('nombre_titular');
            $table->string('apellido_titular');
            $table->unsignedInteger('reservation_id')->nullable();
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
        Schema::dropIfExists('purchases');
    }
}
