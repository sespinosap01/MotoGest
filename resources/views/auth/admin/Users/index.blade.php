@extends('layouts.app')

@section('content')
<style>
    .pointer{
        cursor: pointer;
    }
</style>

<script>
    //script para la ordenacion de las tablas
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
<div class="alert alert-danger mt-3">
    <p>No tienes acceso a esta página</p>
    <a href="/home" class="btn btn-sm btn-dark">Volver</a>
</div>
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
    <form action="{{ route('users.deleteMultiple') }}" method="post" id="deleteMultiple">
        @csrf
        @method('DELETE')
        
        <table class="table table-hover table-striped ">
            <thead>
                <tr>
                    <th><i class="fa-regular fa-trash-can" style="color: red"></i></th>
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
                        <td><input type="checkbox" name="selectedUsers[]" value="{{ $user->idUsuario }}"></td>
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
                            <div class="d-flex justify-content-center">
                                <a href="{{route('user.edit' , $user->idUsuario)}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>   
                            </div>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedUsers" disabled>Eliminar seleccionados</button>
    </form>
    @else
        <p>No hay usuarios registrados en esta pagina</p>
    @endif
    <br><br>
    <!--Paginacion de las tablas-->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->url(1) }}" aria-label="Primera">
                    <span aria-hidden="true">&laquo;&laquo;</span>
                    <span class="sr-only">Primera</span>
                </a>
            </li>
            <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Anterior">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Anterior</span>
                </a>
            </li>
            @php
                $start = max(1, $users->currentPage() - 2);
                $end = min($start + 4, $users->lastPage());
            @endphp
            @for ($i = $start; $i <= $end; $i++)
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
            <li class="page-item {{ $users->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $users->url($users->lastPage()) }}" aria-label="Última">
                    <span aria-hidden="true">&raquo;&raquo;</span>
                    <span class="sr-only">Última</span>
                </a>
            </li>
        </ul>
    </nav>  

@endif
</div>

<script>
        //script de la ventana de sweetalert
    $(document).ready(function () {
        $("#deleteSelectedUsers").on("click", function () {
            var selectedUsers = [];
            $("input[name='selectedUsers[]']:checked").each(function () {
                var userId = $(this).val();
                var userEmail = $(this).closest("tr").find("td:eq(1)").text();
                selectedUsers.push({ id: userId, email: userEmail });
            });

            Swal.fire({
                title: "Confirma la eliminación",
                html: "Vas a eliminar los siguientes usuarios:<br><br>" +
                selectedUsers.map(user => `<b>ID:</b> ${user.id} || <b>Email:</b> ${user.email}`).join("<br>"),
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#5C636A",
                cancelButtonText:"Cancelar",
                confirmButtonText: "Eliminar"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Registros eliminados, actualizando la tabla...",
                        confirmButtonText: "Ok",
                        confirmButtonColor: "#5C636A"
                    });
                     $("#deleteMultiple").submit();
                }
            });
        });
        $("input[name='selectedUsers[]']").on("change", function () {
            var numSelected = $("input[name='selectedUsers[]']:checked").length;
            $("#deleteSelectedUsers").prop("disabled", numSelected === 0);
        });
    });
</script>

@endsection
