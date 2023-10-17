@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
@if(Auth::user()->rol->name == "User")
<p>No tienes acceso a esta página</p>
<a href="/home">Volver</a>
@endif
@if(Auth::user()->rol->name == "Admin")

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('users.index') }}">Gestionar Usuarios</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('motos.index') }}">Gestionar Motos</a>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <a href="{{ route('servicios.index') }}">Gestionar Servicios</a>
            </div>
        </div>
    </div>
</div>
@endif

@endsection
