@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
    @if(Auth::user()->rol->name == "User")
        <p>No tienes acceso a esta página</p>
        <a href="/home">Volver</a>
    @endif

    @if(Auth::user()->rol->name == "Admin")
        <div class="row">
            <div class="col-6">
                <h1>Gestionar Motos</h1>
                <a href="{{ route('moto.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Crear moto</a>
            </div>
            <div class="col-6 text-right">
                <h4>Registros:{{$totalMotos}}</h4>
            </div>
        </div>
        <br>
        @if(count($motos) > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Cilindrada</th>
                        <th>Potencia</th>
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
                            <td>{{ $moto->cilindrada }}cc</td>
                            <td>{{ $moto->potencia }}cv</td>
                            <td>{{ $moto->fechaFabricacion }}</td>
                            <td>{{ $moto->usuario->email }}</td>
                            <td>{{ $moto->matricula }}</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <a href="{{route('moto.edit' , $moto->idMoto)}}" class="btn btn-warning btn-sm">Editar</a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$moto->idMoto}}">Eliminar</button> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <br>
            <p>No hay motos registradas</p>
        @endif
    @endif
    <br><br>
</div>

@foreach ($motos as $moto)
<!-- Modal de confirmación de eliminación -->
<div class="modal top fade" data-mdb-backdrop="false" id="confirmDeleteModal{{$moto->idMoto}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Confirmar eliminación</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar <b>{{$moto->marca}} {{$moto->modelo}}</b>  con ID <b>{{$moto->idMoto}}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('moto.destroy', $moto->idMoto) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
