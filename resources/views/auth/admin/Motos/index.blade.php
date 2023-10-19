@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">

@if(Auth::user()->rol->name == "User")
    <p>No tienes acceso a esta página</p>
    <a href="/home">Volver</a>
@endif

@if(Auth::user()->rol->name == "Admin")
    <div class="row">
        <div class="col-10">
            <h1>Gestionar Motos</h1><a href="{{ route('moto.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Crear moto</a></button>
    
        </div>
        <div class="col-2">
            <h4>Registros:{{$totalMotos}}</h4>
        </div>
    </div>
    @if(count($motos) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Año de fabricación</th>
                    <th>Propietario</th>
                    <th>Matricula</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($motos as $moto)
                    <tr>
                        <th>{{ $moto->idMoto }}</th>
                        <td>{{ $moto->marca }}</td>
                        <td>{{ $moto->modelo }}</td>
                        <td>{{ $moto->fechaFabricacion }}</td>
                        <td>{{ $moto->usuario->email }}</td>
                        <td>{{ $moto->matricula }}</td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="{{route('moto.edit' , $moto->idMoto)}}" class="btn btn-warning btn-sm">Editar</a>   
                                <form action="{{ route('moto.destroy', $moto->idMoto) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay motos registradas</p>
    @endif

@endif
</div>

@endsection
