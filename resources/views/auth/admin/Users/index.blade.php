@extends('layouts.app')

@section('content')
<style>
    .pointer{
        cursor: pointer;
    }
</style>

<script>
    var sortOrder = -1; 
    $(document).ready(function () {
        var table = document.querySelector("table");
        function sortTable(col) {
            var tbody = table.tBodies[0];
            var rows = Array.from(tbody.rows);

            rows.sort((a, b) => {
                var valA = a.cells[col].textContent.trim().toLowerCase();
                var valB = b.cells[col].textContent.trim().toLowerCase();
                if (!isNaN(valA) && !isNaN(valB)) {
                    valA = parseFloat(valA);
                    valB = parseFloat(valB);
                }
                return (valA > valB ? 1 : -1) * sortOrder;
            });

            tbody.innerHTML = "";
            rows.forEach((row) => tbody.appendChild(row));
        }

        $("#th-id, #th-email, #th-rol").on("click", function () {
            var col = $(this).index();
            sortTable(col);
            sortOrder *= -1; 
        });
    });
</script>


<div class="container" data-aos="fade-up">

@if(Auth::user()->rol->name == "User")
    <p>No tienes acceso a esta página</p>
    <a href="/home">Volver</a>
@endif

@if(Auth::user()->rol->name == "Admin")
    
<div class="row">
    <div class="col-6">
        <h1><i class="fa-solid fa-user" style="color: #c65f20;"></i> Gestionar Usuarios</h1><a href="{{ route('user.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Crear usuario</a></button>

    </div>
    <div class="col-6 text-right">
        <h4>Registros: {{ $totalUsers }}</h4>
    </div>
</div>
<br>

    @if(count($users) > 0)
        <table class="table table-hover table-striped ">
            <thead>
                <tr>
                    <th id="th-id" style="cursor: pointer">ID <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>
                    <th id="th-email" style="cursor: pointer">Email <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>                    
                    <th>Nombre</th>                    
                    <th>Fecha de Nacimiento</th>
                    <th>Numero de telefono</th>
                    <th>Fecha de Registro</th>
                    <th id="th-rol" style="cursor: pointer">Rol <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>                    
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th class="pr-4">{{ $user->idUsuario }} </th>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->nombre }}</td>
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
                                <a href="{{route('user.edit' , $user->idUsuario)}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>   
                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$user->idUsuario}}"><i class="fa-regular fa-trash-can"></i></button> 
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay usuarios registrados en esta pagina</p>
    @endif
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                </a>
            </li>
            @for ($i = 1; $i <= $users->lastPage(); $i++)
                <li class="page-item {{ $i == $users->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a>
                </li>
            @endfor
            <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Siguiente">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </li>
        </ul>
    </nav>

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
