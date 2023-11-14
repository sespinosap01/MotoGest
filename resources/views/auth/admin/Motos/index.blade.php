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
    <div class="alert alert-danger mt-3">
        <p>No tienes acceso a esta página</p>
        <a href="/home" class="btn btn-sm btn-dark">Volver</a>
    </div>
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
        <form action="{{ route('motos.deleteMultiple') }}" method="post" id="deleteMultiple">
            @csrf
            @method('DELETE')
            
        <table class="table table-hover table-striped ">
            <thead>
                    <tr>
                        <th><i class="fa-regular fa-trash-can" style="color: red"></i></th>
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
                            <td><input type="checkbox" name="selectedMotos[]" value="{{ $moto->idMoto }}"></td>
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
                                <div class="d-flex justify-content-center">
                                    <a href="{{route('moto.edit' , $moto->idMoto)}}" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
        <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedMotos" disabled>Eliminar seleccionados</button>

    </form>
        @else
            <br>
            <p>No hay motos registradas</p>
        @endif
        <br><br>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $motos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $motos->url(1) }}" aria-label="Primera">
                        <span aria-hidden="true">&laquo;&laquo;</span>
                        <span class="sr-only">Primera</span>
                    </a>
                </li>
                <li class="page-item {{ $motos->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $motos->previousPageUrl() }}" aria-label="Anterior">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </li>
                @php
                    $start = max(1, $motos->currentPage() - 2);
                    $end = min($start + 4, $motos->lastPage());
                @endphp
                @for ($i = $start; $i <= $end; $i++)
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
                <li class="page-item {{ $motos->hasMorePages() ? '' : 'disabled' }}">
                    <a class="page-link" href="{{ $motos->url($motos->lastPage()) }}" aria-label="Última">
                        <span aria-hidden="true">&raquo;&raquo;</span>
                        <span class="sr-only">Última</span>
                    </a>
                </li>
            </ul>
        </nav>
        
    @endif
    <br><br>
</div>

<script>
    $(document).ready(function () {
        $("#deleteSelectedMotos").on("click", function () {
            var selectedMotos = [];
            $("input[name='selectedMotos[]']:checked").each(function () {
                var motoID = $(this).val();
                var motoMarca = $(this).closest("tr").find("td:eq(1)").text();
                var motoModelo = $(this).closest("tr").find("td:eq(2)").text(); 

                selectedMotos.push({ id: motoID, marca: motoMarca, modelo: motoModelo });
            });

            Swal.fire({
                title: "Confirma la eliminación",
                html: "Vas a eliminar las siguientes motos:<br><br>" +
                selectedMotos.map(moto => `<b>ID:</b> ${moto.id} || ${moto.marca} ${moto.modelo}`).join("<br>"),
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
        $("input[name='selectedMotos[]']").on("change", function () {
            var numSelected = $("input[name='selectedMotos[]']:checked").length;
            $("#deleteSelectedMotos").prop("disabled", numSelected === 0);
        });
    });
</script>
@endsection
