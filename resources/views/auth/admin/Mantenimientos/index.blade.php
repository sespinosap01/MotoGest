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
                <h1>Gestionar Mantenimientos</h1>
            </div>
            <div class="col-2">
                <h4>Registros:{{$totalMantenimientos}}</h4>
            </div>
        </div>

        @if(count($mantenimientos) > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID mantenimiento</th>
                        <th>Moto</th>
                        <th>Matricula</th>
                        <th>Kilometraje</th>
                        <th>Rueda trasera</th>
                        <th>Rueda delantera</th>
                        <th>Vencimiento Seguro</th>
                        <th>Vencimiento ITV</th>
                        <th>Aceite</th>
                        <th>Reglaje de válvulas</th>
                        <th>Gastos</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($mantenimientos as $mantenimiento)
                        <tr>
                            <td>{{ $mantenimiento->idMantenimiento }}</td>
                            <td>{{ $mantenimiento->Moto->marca }} {{ $mantenimiento->Moto->modelo }}</td>
                            <td>{{ $mantenimiento->Moto->matricula }}</td>
                            <td>{{ $mantenimiento->kilometraje }}km</td>
                            <td>{{ $mantenimiento->kmRuedaTrasera }}km</td>
                            <td>{{ $mantenimiento->kmRuedaDelantera }}km</td>
                            <td>{{ \Carbon\Carbon::parse($mantenimiento->fechaVencimientoSeguro)->format('d/m/Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($mantenimiento->fechaVencimientoITV)->format('d/m/Y') }}</td>
                            <td>{{ $mantenimiento->kmAceiteMotor }}km</td>
                            <td>{{ $mantenimiento->kmReglajeValvulas }}km</td>
                            <td>{{ $mantenimiento->gastosGeneral }}€</td>
                            <td>
                                <div class="d-flex gap-3">
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$mantenimiento->idMantenimiento}}">Eliminar</button> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <br>
            <p>No hay mantenimientos registradas</p>
        @endif
    @endif
    <br><br>
</div>
@foreach ($mantenimientos as $mantenimiento)
<!-- Modal de confirmación de eliminación -->
<div class="modal top fade" data-mdb-backdrop="false" id="confirmDeleteModal{{$mantenimiento->idMantenimiento}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Confirmar eliminación</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar el mantenimiento con ID <b>{{$mantenimiento->idMantenimiento}}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('mantenimiento.destroy', $mantenimiento->idMantenimiento) }}" method="POST">
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