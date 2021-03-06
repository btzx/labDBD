 create table "users" ("id" serial primary key not null, "name" varchar(255) not null, "email" varchar(255) not null, "email_verified_at" timestamp(0) without time zone null, "password" varchar(255) not null, "remember_token" varchar(100) null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "users" add constraint "users_email_unique" unique ("email");
 create table "password_resets" ("email" varchar(255) not null, "token" varchar(255) not null, "created_at" timestamp(0) without time zone null);
 create index "password_resets_email_index" on "password_resets" ("email");
 create table "destinies" ("id" serial primary key not null, "ciudad" varchar(60) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "origins" ("id" serial primary key not null, "ciudad" varchar(60) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "reservations" ("id" serial primary key not null, "monto" integer not null, "num_pasaporte" integer not null, "num_reserva_hotel" integer not null, "origin_id" integer not null, "destiny_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "reservations" add constraint "reservations_destiny_id_foreign" foreign key ("destiny_id") references "destinies" ("id");
 alter table "reservations" add constraint "reservations_origin_id_foreign" foreign key ("origin_id") references "origins" ("id");
 create table "airports" ("id" serial primary key not null, "ciudad" varchar(60) not null, "nombre" varchar(60) not null, "origin_id" integer not null, "destiny_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "airports" add constraint "airports_origin_id_foreign" foreign key ("origin_id") references "origins" ("id");
 alter table "airports" add constraint "airports_destiny_id_foreign" foreign key ("destiny_id") references "destinies" ("id");
 create table "socios" ("id" serial primary key not null, "numero" integer not null, "email" varchar(255) not null, "millas" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "flights" ("id" serial primary key not null, "fecha_ida" date not null, "capacidad" smallint not null, "num_pasajeros" smallint not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "administrators" ("id" serial primary key not null, "nombre" varchar(40) not null, "apellido" varchar(40) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "tickets" ("id" serial primary key not null, "num_asiento" smallint not null, "hora" timestamp(0) without time zone not null, "origen" varchar(80) not null, "destino" varchar(80) not null, "doc_identificacion" varchar(40) not null, "tipo_pasajero" varchar(20) not null, "flight_id" integer not null, "reservation_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "tickets" add constraint "tickets_flight_id_foreign" foreign key ("flight_id") references "flights" ("id");
 alter table "tickets" add constraint "tickets_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 create table "check_ins" ("id" serial primary key not null, "cuenta" integer not null, "num_vuelo" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "purchases" ("id" serial primary key not null, "fecha" timestamp(0) without time zone not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "stops" ("id" serial primary key not null, "nombre" varchar(60) not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "passengers" ("id" serial primary key not null, "nombre" varchar(255) not null, "apellido" varchar(255) not null, "num_asiento" integer not null, "flight_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "passengers" add constraint "passengers_flight_id_foreign" foreign key ("flight_id") references "flights" ("id");
 create table "packages" ("id" serial primary key not null, "descuento" integer not null, "fecha_vencimiento" timestamp(0) without time zone not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "cars" ("id" serial primary key not null, "patente" varchar(255) not null, "marca" varchar(255) not null, "modelo" varchar(255) not null, "capacidad" decimal(8, 2) not null, "package_id" integer not null, "reservation_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "cars" add constraint "cars_package_id_foreign" foreign key ("package_id") references "packages" ("id");
 alter table "cars" add constraint "cars_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 create table "reservation_users" ("id" serial primary key not null, "reservation_id" integer not null, "user_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "reservation_users" add constraint "reservation_users_user_id_foreign" foreign key ("user_id") references "users" ("id");
 alter table "reservation_users" add constraint "reservation_users_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 create table "hotels" ("id" serial primary key not null, "ciudad" varchar(255) not null, "nombre" varchar(255) not null, "clase" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 create table "rooms" ("id" serial primary key not null, "numero" integer not null, "hotel_id" integer not null, "capacidad" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "rooms" add constraint "rooms_hotel_id_foreign" foreign key ("hotel_id") references "hotels" ("id");
 create table "hotel_reservations" ("id" serial primary key not null, "cantidad_personas" decimal(8, 2) not null, "room_id" integer not null, "package_id" integer not null, "reservation_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "hotel_reservations" add constraint "hotel_reservations_room_id_foreign" foreign key ("room_id") references "rooms" ("id");
 alter table "hotel_reservations" add constraint "hotel_reservations_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 alter table "hotel_reservations" add constraint "hotel_reservations_package_id_foreign" foreign key ("package_id") references "packages" ("id");
 create table "stopflights" ("id" serial primary key not null, "stop_id" integer not null, "flight_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "stopflights" add constraint "stopflights_flight_id_foreign" foreign key ("flight_id") references "flights" ("id");
 alter table "stopflights" add constraint "stopflights_stop_id_foreign" foreign key ("stop_id") references "stops" ("id");
 create table "reservationflights" ("id" serial primary key not null, "reservation_id" integer not null, "flight_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "reservationflights" add constraint "reservationflights_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 alter table "reservationflights" add constraint "reservationflights_flight_id_foreign" foreign key ("flight_id") references "flights" ("id");
 create table "clientreservations" ("user_id" integer not null, "reservation_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "clientreservations" add constraint "clientreservations_user_id_foreign" foreign key ("user_id") references "users" ("id");
 alter table "clientreservations" add constraint "clientreservations_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 
            CREATE OR REPLACE FUNCTION agregarPasajeros()
            RETURNS trigger AS
            $$
                DECLARE
                i INTEGER := 25;
                j INTEGER := 0;
                num_asiento INTEGER:= 2;
                nombre VARCHAR:= 'benjamin' ;
                apellido VARCHAR:= 'tapia';
                valor INTEGER := NEW.id;
                BEGIN           
                LOOP 
                    EXIT WHEN j = i;
                    j := j + 1;
                    INSERT INTO passengers( flight_id,nombre,apellido,num_asiento,created_at,updated_at) VALUES 
                    (valor,nombre,apellido,j, NEW.created_at,NEW.updated_at);
                END LOOP ;
                RETURN NEW;
            END
            $$ LANGUAGE plpgsql;
        
PassengerTrigger: 
        CREATE TRIGGER agregarPasajeros AFTER INSERT ON flights FOR EACH ROW
        EXECUTE PROCEDURE agregarPasajeros();
        
 create table "reservation_administrators" ("id" serial primary key not null, "reservation_id" integer not null, "administrator_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "reservation_administrators" add constraint "reservation_administrators_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 alter table "reservation_administrators" add constraint "reservation_administrators_administrator_id_foreign" foreign key ("administrator_id") references "administrators" ("id");
 create table "administrator_packages" ("id" serial primary key not null, "administrator_id" integer not null, "package_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "administrator_packages" add constraint "administrator_packages_administrator_id_foreign" foreign key ("administrator_id") references "administrators" ("id");
 alter table "administrator_packages" add constraint "administrator_packages_package_id_foreign" foreign key ("package_id") references "packages" ("id");
 create table "userreservations" ("id" serial primary key not null, "user_id" integer not null, "reservation_id" integer not null);
 alter table "userreservations" add constraint "userreservations_user_id_foreign" foreign key ("user_id") references "users" ("id");
 alter table "userreservations" add constraint "userreservations_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 create table "reservationpackages" ("id" serial primary key not null, "reservation_id" integer not null, "package_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "reservationpackages" add constraint "reservationpackages_reservation_id_foreign" foreign key ("reservation_id") references "reservations" ("id");
 alter table "reservationpackages" add constraint "reservationpackages_package_id_foreign" foreign key ("package_id") references "packages" ("id");
 create table "flightpackages" ("id" serial primary key not null, "flight_id" integer not null, "package_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "flightpackages" add constraint "flightpackages_flight_id_foreign" foreign key ("flight_id") references "flights" ("id");
 alter table "flightpackages" add constraint "flightpackages_package_id_foreign" foreign key ("package_id") references "packages" ("id");
 create table "hotelreservation_packages" ("id" serial primary key not null, "hotel_reservation_id" integer not null, "package_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
 alter table "hotelreservation_packages" add constraint "hotelreservation_packages_hotel_reservation_id_foreign" foreign key ("hotel_reservation_id") references "hotel_reservations" ("id");
 alter table "hotelreservation_packages" add constraint "hotelreservation_packages_package_id_foreign" foreign key ("package_id") references "packages" ("id");
create table "seats" ("id" serial primary key not null, "letra" char(1) not null, "numero" integer not null, "disponibilidad" boolean not null, "flight_id" integer not null, "created_at" timestamp(0) without time zone null, "updated_at" timestamp(0) without time zone null);
alter table "seats" add constraint "seats_flight_id_foreign" foreign key ("flight_id") references "flights" ("id");
















