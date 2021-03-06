<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TriggerRooms extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
        {
        DB::statement('
            CREATE OR REPLACE FUNCTION habilitarDisponibilidad()
            RETURNS trigger AS
            $$
                DECLARE
                limite INTEGER := 10;
                n INTEGER := 0;
                disponible BOOLEAN := true;
                rdm INTEGER := 1;
                rand INTEGER := 1;
                price INTEGER := 0;
                valor INTEGER := NEW.id;
                this DATE := current_date;
                next DATE := current_date;
                BEGIN
                LOOP
                    EXIT WHEN n = limite;
                    n := n + 1;
                    rdm:= ((rdm * 1.5 * n * valor)%4) + 1;
                    rand:= ((rdm * 1.5 * n * valor)%10) +1;
                    this:= this + 3;
                    next:= next + 4;
                    price:= rdm * 175;
                    INSERT INTO rooms(hotel_id,numero, capacidad, disponible, precio, dias, created_at, updated_at, fecha_ida, fecha_vuelta, package_id)
                    VALUES (valor,n, rdm, disponible, price, 0, NEW.created_at, NEW.updated_at, this, next, rand);
                END LOOP;
                RETURN NEW;
            END
            $$ LANGUAGE plpgsql;
        ');
        DB::unprepared('
        CREATE TRIGGER crearHabitacion AFTER INSERT ON hotels FOR EACH ROW
        EXECUTE PROCEDURE habilitarDisponibilidad();
        ');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trigger_rooms');
    }
}
