@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
    @if(Auth::user()->rol->name == "User")
        <div class="alert alert-danger mt-3">
            <p>No tienes acceso a esta página</p>
            <a href="/home" class="btn btn-primary">Volver</a>
        </div>
    @endif
    @if(Auth::user()->rol->name == "Admin")
        <div class="row justify-content-center mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Gestionar Usuarios</h2>
                        <img src="{!! asset('images/iconos/iconUser.png') !!}" width="150px" alt="imgIcon"><br><br>
                        <a href="{{ route('users.index') }}" class="btn text-white" style="background-color: #c65f20;">Ir a Usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Gestionar Motos</h2>
                        <img src="{!! asset('images/iconos/iconMoto.png') !!}" width="150px" alt="imgIcon"><br><br>
                        <a href="{{ route('motos.index') }}" class="btn text-white" style="background-color: #c65f20;">Ir a Motos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <h2 class="card-title">Gestionar Mantenimientos</h2>
                        <img src="{!! asset('images/iconos/iconTool.png') !!}" width="150px" alt="imgIcon"><br><br>
                        <a href="{{ route('mantenimientos.index') }}" class="btn text-white" style="background-color: #c65f20;">Ir a Mantenimientos</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
