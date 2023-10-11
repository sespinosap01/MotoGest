@extends('layouts.app')

@section('content')
    <h1>Lista de Usuarios</h1>

    <table>
        <thead>
            <tr>
                <th>Id Usuario</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Nacimiento</th>
                <th>Numero de telefono</th>
                <th>Fecha de Registro</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->idUsuario }}</td>
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
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
