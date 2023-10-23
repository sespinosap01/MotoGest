@extends('layouts.app')

@section('content')
<div class="container">

@if(Auth::user()->rol->name == "User")
<p>No tienes acceso a esta página</p>
<a href="/home">Volver</a>
@endif
@if(Auth::user()->rol->name == "Admin")
    <h1>Gestionar Mantenimientos</h1>

@endif
</div>

@endsection
