<?php

namespace App\Http\Controllers;

use App\car;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use \App\ReservationUser;
use \App\reservation;
use Illuminate\Support\Facades\Auth;
class CarController extends Controller
{

    public function rules(){
        return[
            'patente' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'capacidad' => 'required|string'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = car::all();
        return view('cars.principal',compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $car = new \App\car;
        $car->patente = $request->get('patente');
        $car->marca = $request->get('marca');
        $car->modelo = $request->get('modelo');
        $car->capacidad = $request->get('capacidad');
        $car->reservation_id = $request->get('reservation_id');
        $car->package_id = $request->get('package_id');
        $car->save();
        return $car;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\car  $car
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $car = Car::find($id);
        return $car; 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\car  $car
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\car  $car
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, car $car)
    {
        $validator = Validator::make($request->all(), $this->rules());
        if($validator->fails()){
            return $validator->messages();
        }
        $car->patente = $request->get('patente');
        $car->marca = $request->get('marca');
        $car->modelo = $request->get('modelo');
        $car->capacidad = $request->get('capacidad');
        $car->reservation_id = $request->get('reservation_id');
        $car->package_id = $request->get('package_id');
        $car->save();
        return $car;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\car  $car
     * @return \Illuminate\Http\Response
     */
    public function destroy(car $car)
    {
        $car->delete();
        return response()->json([
            'success'
        ]);
    }

    public function reservarAuto(Request $request){
        //obtengo el id del auto y del usuario
        $id_auto = $request->id;
         $user = Auth::id();
         //creo reserva y reservausuario
         $reserva = new \App\reservation;
         $reservation_user = new \App\ReservationUser;
         $reservation_user->user_id = $user;
         $reservation_user->reservation_id = $reserva->id;

         //link a la reserva



         $request->reservation_id = $reserva->id;

        return $reserva;
    }
}
