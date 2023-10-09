@extends('layouts.app')

@section('content')

@if(Auth::user()->rol->name == "User")
<p>No tienes acceso a esta página</p>
<a href="/home">Volver</a>
@endif
@if(Auth::user()->rol->name == "Admin")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="">Gestionar Users</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <a href="">Gestionar Motos</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <a href="">Gestionar Servicios</a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
