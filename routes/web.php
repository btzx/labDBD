<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes();


Route::resource('/airports', 'AirportController');
Route::resource('/administrators', 'AdministratorController');
Route::resource('/flights', 'FlightController');
Route::resource('/tickets', 'TicketController');
Route::resource('/cars', 'CarController');
Route::resource('/check_ins', 'CheckInController');
Route::resource('/hotels', 'HotelController');
Route::resource('/packages', 'PackageController');
Route::resource('/rooms', 'RoomController');
Route::resource('/purchases', 'PurchaseController');
Route::resource('/users', 'UserController');
Route::resource('/destinies', 'DestinyController');
Route::resource('/origins','OriginController');
Route::resource('/passengers','PassengerController');
Route::resource('/reservations','ReservationController');
Route::resource('/stops','StopController');
Route::resource('/stopflights','StopflightController');
Route::resource('/reservation_users','ReservationUserController');
Route::resource('/seats', 'SeatController');
Route::resource('/secures', 'SecureController');

Route::post('/vuelos/busqueda','FlightController@buscar');
Route::post('/vuelos/reserva','FlightController@reservarVuelo');
Route::post('/cart','CarController@reservarAuto');
Route::post('/vuelos/busquedaporfecha','FlightController@buscarporfecha');

Route::get('/vuelos/reserva','FlightController@reservarVuelo');
Route::post('/paquetes/reserva','PackageController@reservarPaquete');

Route::post('/hoteles/ciudad','HotelController@verHoteles');
Route::post('/hoteles/habitaciones','HotelController@verHabitaciones');

Route::resource('/carrito', 'CarritoController'); 

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth','admin']],function(){
	Route::get('/admin',function(){
		return view('admin');
	});
});
