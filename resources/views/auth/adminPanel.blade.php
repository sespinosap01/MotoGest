@extends('layouts.app')

@section('content')
<style>
    .transition {
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .transition:hover {
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        transform: translate(0, -5px);
    }

</style>
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
                <div class="card mb-4 transition shadow">
                    <div class="card-body text-center">
                        <h2 class="card-title">Usuarios</h2>
                        <img src="{!! asset('images/iconos/iconUser.png') !!}" width="100px" alt="imgIcon"><br><br>
                        <a href="{{ route('users.index') }}" class="btn text-white" style="background-color: #c65f20;">Gestionar usuarios</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 transition shadow">
                    <div class="card-body text-center">
                        <h2 class="card-title">Motos</h2>
                        <img src="{!! asset('images/iconos/iconMoto.png') !!}" width="100px" alt="imgIcon"><br><br>
                        <a href="{{ route('motos.index') }}" class="btn text-white" style="background-color: #c65f20;">Gestionar motos</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4 transition shadow">
                    <div class="card-body text-center">
                        <h2 class="card-title">Mantenimientos</h2>
                        <img src="{!! asset('images/iconos/iconTool.png') !!}" width="100px" alt="imgIcon"><br><br>
                        <a href="{{ route('mantenimientos.index') }}" class="btn text-white" style="background-color: #c65f20;">Gestionar mantenimientos</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
