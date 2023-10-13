@extends('layouts.app')

@section('content')
<div class="container">

@if(Auth::user()->rol->name == "User")
<p>No tienes acceso a esta página</p>
<a href="/home">Volver</a>
@endif
@if(Auth::user()->rol->name == "Admin")
    <h1>Gestionar Motos</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>ID Propietario</th>

                <th>Acciones</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($motos as $moto)
                <tr>
                    <th>{{ $moto->idMoto }}</th>
                    <td>{{ $moto->marca }}</td>
                    <td>{{ $moto->modelo }}</td>
                    <td>{{ $moto->idUsuario }}</td>
                    <td><button class="btn btn-warning btn-sm">Editar</button><button class="btn btn-danger btn-sm">Eliminar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @endif
</div>

@endsection
