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
        <h1>Gestionar Usuarios</h1><a href="{{ route('user.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Crear usuario</a></button>

    </div>
    <div class="col-2">
        <h4>Registros: {{ $totalUsers }}</h4>
    </div>
</div>

    @if(count($users) > 0)
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Fecha de Nacimiento</th>
                    <th>Numero de telefono</th>
                    <th>Fecha de Registro</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->idUsuario }}</th>
                        <td>{{ $user->nombre }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->fechaNacimiento)->format('d/m/Y') }}</td>
                        <td>{{ $user->numTelefono }}</td>
                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i:s') }}</td>
                        <td>
                            @if ($user->rol_id == 2)
                                Admin
                            @elseif ($user->rol_id == 1)
                                Usuario
                            @else
                                Otro
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-3">
                                <a href="{{route('user.edit' , $user->idUsuario)}}" class="btn btn-warning btn-sm">Editar</a>   
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$user->idUsuario}}">Eliminar</button> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay usuarios registrados</p>
    @endif

@endif
</div>
@foreach ($users as $user)
<!-- Modal de confirmación de eliminación -->
<div class="modal top fade" data-mdb-backdrop="false" id="confirmDeleteModal{{$user->idUsuario}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Confirmar eliminación</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar a <b>{{$user->nombre}} con ID <b>{{$user->idUsuario}}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('user.destroy', $user->idUsuario) }}" method="POST">
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
