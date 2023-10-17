@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">

@if(Auth::user()->rol->name == "User")
    <p>No tienes acceso a esta página</p>
    <a href="/home">Volver</a>
@endif

@if(Auth::user()->rol->name == "Admin")
    <h1>Gestionar Usuarios</h1>
    <a href="{{ route('user.create') }}" class="btn btn-info btn-sm">Crear usuario</a></button>

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
                            <a href="{{route('user.edit' , $user->idUsuario)}}" class="btn btn-warning btn-sm">Editar</a>   
                            <form action="{{route('user.destroy', $user->idUsuario)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
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
@endsection
