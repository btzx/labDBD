
<div class="container">
@foreach($flights as $f)
<div class ="well">
  <form action="/vuelos/reserva" method="GET">
{{$f->id}}
capacidad: {{$f->capacidad}}
<input type="submit"  value="reservar">
</form>
</div>
@endforeach
</div>