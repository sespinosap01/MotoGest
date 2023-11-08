@extends('layouts.app')

@section('content')
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

        $("#th-id, #th-anio, #th-propietario").on("click", function () {
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
                <h1><i class="fa-solid fa-motorcycle" style="color: #c65f20;"></i> Gestionar Motos</h1>
                <a href="{{ route('moto.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Crear moto</a>
            </div>
            <div class="col-6 text-right">
                <h4>Registros:{{$totalMotos}}</h4>
            </div>
        </div>
        <br>
        @if(count($motos) > 0)
        <table class="table table-hover table-striped ">
            <thead>
                    <tr>
                        <th id="th-id" style="cursor: pointer">ID <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Cilindrada</th>
                        <th>Potencia</th>
                        <th id="th-anio" style="cursor: pointer">Año de fabricación <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>
                        <th id="th-propietario" style="cursor: pointer">Propietario <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>
                        <th>Matricula</th>
                        <th>Foto</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($motos as $moto)
                        <tr>
                            <th class="pr-4">{{ $moto->idMoto }}</th>
                            <td>{{ $moto->marca }}</td>
                            <td>{{ $moto->modelo }}</td>
                            <td>{{ $moto->cilindrada }}cc</td>
                            <td>{{ $moto->potencia }}cv</td>
                            <td>{{ $moto->fechaFabricacion }}</td>
                            <td>{{ $moto->usuario->email }}</td>
                            <td>{{ $moto->matricula }}</td>
                            @if ($moto->imagen)
                            <td><img src="{{ asset($moto->imagen)}}" alt="imgFoto" style="width:35px; height:35px; border-radius:24px; object-fit: cover;"></td>
                            @else
                            <td><img src="{{ asset("images/iconos/motoDefault.png")}}" alt="imgFoto" style="width:35px; height:35px; border-radius:24px; object-fit: cover;"></td>
                            @endif
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
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $motos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $motos->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $motos->lastPage(); $i++)
                    <li class="page-item {{ $i == $motos->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $motos->url($i) }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ $motos->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $motos->nextPageUrl() }}" aria-label="Siguiente">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Siguiente</span>
                    </a>
                </li>
            </ul>
        </nav>
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
