@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
   <h1>¡Hola {{ Auth::user()->nombre }}!</h1>

      <p>Aquí iria informacion de la web, fotos promocionales... etc</p>
</div>
@endsection
