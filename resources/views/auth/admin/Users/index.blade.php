@extends('layouts.app')

@section('content')
<div class="container">

@if(Auth::user()->rol->name == "User")
<p>No tienes acceso a esta página</p>
<a href="/home">Volver</a>
@endif
@if(Auth::user()->rol->name == "Admin")
    <h1>Gestionar Usuarios</h1>
    <button class="btn btn-info btn-sm">Crear usuario</button>

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
                    <td>{{ $user->fechaNacimiento }}</td>
                    <td>{{ $user->numTelefono }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        @if ($user->rol_id == 2)
                            Admin
                        @elseif ($user->rol_id == 1)
                            Usuario
                        @else
                            Otro
                        @endif
                    </td>
                    <td><button class="btn btn-warning btn-sm">Editar</button><button class="btn btn-danger btn-sm">Eliminar</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div>
@endsection
