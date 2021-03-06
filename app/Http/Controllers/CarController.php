<?php

namespace App\Http\Controllers;

use App\car;
use App\Carrito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use \App\ReservationUser;
use \App\reservation;
use Auth;
use Illuminate\Support\Str;
use Session;
use \App\User;
use Carbon\Carbon;
use Spatie\Activitylog\Traits\LogsActivity;
class CarController extends Controller
{

    public function rules(){
        return[
            'patente' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'capacidad' => 'required|integer',
            'precio' => 'required|integer'
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
        $user = Auth::user();
        if ($user->is_admin) {
          return view('cars.crear');
        }
        else {
          abort(401);
        }
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
        $user = Auth::user();
        if ($user->is_admin) {
          $car = new \App\car;
          $car->patente = $request->get('patente');
          $car->marca = $request->get('marca');
          $car->modelo = $request->get('modelo');
          $car->capacidad = $request->get('capacidad');
          $car->precio = $request->get('precio');
          $car->fecha_ida = $request->get('fecha_ida');
          $car->fecha_vuelta = $request->get('fecha_vuelta');
          $car->disponibilidad = $request->get('disponibilidad');
          $car->destiny_id = $request->get('destiny_id');
          //$car->reservation_id = 1;
          $car->package_id = $request->get('package_id');
          $car->save();
          activity('Auto')
              ->performedOn($user)
              ->causedBy($user)
              ->withProperties([
                   'causante'    => $user->name,
                ])
              ->log("Creacion de auto $auto->marca $auto->modelo");
          $cars = car::all();
          return view('cars.principal', compact('cars'));
        }
        else {
          return view('cars.principal');
        }
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
        $user = Auth::user();
        $car = car::find($id);
        if ($user->is_admin) {
          return view('cars.editar', compact('car'));
        }
        else {
          abort(401);
        }
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
        $user = Auth::user();
        $car->patente = $request->get('patente');
        $car->marca = $request->get('marca');
        $car->modelo = $request->get('modelo');
        $car->capacidad = $request->get('capacidad');
        $car->precio = $request->get('precio');
        $car->fecha_ida = $request->get('fecha_ida');
        $car->fecha_vuelta = $request->get('fecha_vuelta');
        $car->disponibilidad = $request->get('disponibilidad');
        $car->destiny_id = $request->get('destiny_id');
        $car->package_id = $request->get('package_id');
        $car->save();
        activity('Auto')
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                 'causante'    => $user->name,
              ])
            ->log("Edita auto con id $auto->id");
        $cars = car::all();
        Session::flash('flash_message', 'Auto editado');
        return view('cars.principal', compact('cars'));
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
        $auto = \App\Car::find($request->id_auto);
        $user = Auth::user();
        //dd($user->name);
        $carrito = $user->carrito;
        if ($carrito == null OR $carrito->disponibilidad == false){
            $carrito = new \app\Carrito;
            $carrito->fecha = Carbon::now();
            $carrito->user_id = $user->id;
            $carrito->save();
        }
        $reserva_aux = $user->reservation->last();
        if ($reserva_aux==null) {
            $reserva = new \App\reservation;
            $reserva->cod_reserva = Str::random(16);
            $reserva->precio = $reserva->precio + $auto->precio;
            $reserva->user_id = $user->id;
            $reserva->fecha_reserva = Carbon::now();
            $reserva->disponibilidad= true;
            $reserva->save();
        }
        else{
            $booleano = \App\reservation::all()->last()->disponibilidad;
            if($booleano==false){
                $reserva = new \App\reservation;
                $reserva->cod_reserva = Str::random(16);
                $reserva->precio = $reserva->precio + $auto->precio;
                $reserva->user_id = $user->id;
                $reserva->fecha_reserva = Carbon::now();
                $reserva->save();
            }
            else{
                $reserva = \App\reservation::all()->last();
                $reserva->precio = $reserva->precio + $auto->precio;
                $reserva->save();
            }
        }
        $auto->reservation_id = $reserva->id;
        $auto->disponibilidad = false;
        $auto->save();
        activity('Auto')
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                 'causante'    => $user->name,
              ])
            ->log("Reserva de auto $auto->marca $auto->modelo");
        //return view('cart',compact('reserva','request'));
        return redirect()->action('CarritoController@show',['id' => $user->id]);
    }

    public function buscarAuto(Request $request){
        $user = Auth::user();
        $fecha_ida = $request->fecha_ida;
        $fecha_vuelta = $request->fecha_vuelta;
        $lugar_arriendo = $request->lugar_arriendo;
        $autos = \App\car::where('fecha_ida','<=',$request->fecha_ida)->where('fecha_vuelta','>=',$request->fecha_vuelta)->get();
        $cars=[];
        foreach ($autos as $auto) {
            if($auto->destiny->ciudad == $request->lugar_arriendo){
                $cars[]=$auto;
            }
        }
        activity('Auto')
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                 'causante'    => $user->name,
              ])
            ->log("Busqueda de auto con fecha de ida $fecha_ida");
        return view('cars.buscar',compact('cars'));
    }

    public function quitarDelCarrito(Request $request){
        $user = Auth::user();
        $id = $user->id;
        $auto = \App\Car::find($request->id_auto);
        $auto->reservation_id = null;
        $auto->disponibilidad = true;
        $auto->dias = 0;
        $auto->save();
        activity('Auto')
            ->performedOn($user)
            ->causedBy($user)
            ->withProperties([
                 'causante'    => $user->name,
              ])
            ->log("Se quita auto $auto->marca $auto->modelo del carrito");
        return redirect()->action('CarritoController@show',['id' => $user->id]);
    }
}
