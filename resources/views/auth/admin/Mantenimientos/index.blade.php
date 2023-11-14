@extends('layouts.app')

@section('content')
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

        $("#th-id, #th-moto").on("click", function () {
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
                <h1><i class="fa-solid fa-wrench" style="color: #c65f20;"></i> Gestionar Mantenimientos</h1>
            </div>
            <div class="col-6 text-right">
                <h4>Registros:{{$totalMantenimientos}}</h4>
            </div>
        </div>

        @if(count($mantenimientos) > 0)
        <form action="{{ route('mantenimientos.deleteMultiple') }}" method="post" id="deleteMultiple">
            @csrf
            @method('DELETE')
            
        <table class="table table-hover table-striped ">
                <thead>
                    <tr>
                        <th><i class="fa-regular fa-trash-can" style="color: red"></i></th>
                        <th id="th-id" style="cursor: pointer">ID <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>
                        <th id="th-moto" style="cursor: pointer">Moto <i class="fa-solid fa-sort" style="color: #c65f20"></i></th>
                        <th>Matrícula</th>
                        <th>Kilometraje</th>
                        <th>Rueda trasera</th>
                        <th>Rueda delantera</th>
                        <th>Vencimiento Seguro</th>
                        <th>Vencimiento ITV</th>
                        <th>Aceite</th>
                        <th>Reglaje de válvulas</th>
                        <th>Gastos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mantenimientos as $mantenimiento)
                        <tr>
                            <td><input type="checkbox" name="selectedMantenimientos[]" value="{{ $mantenimiento->idMantenimiento }}"></td>
                            <th class="pr-4">{{ $mantenimiento->idMantenimiento }}</th>
                            <td>{{ $mantenimiento->Moto->marca }} {{ $mantenimiento->Moto->modelo }}</td>
                            <td>{{ $mantenimiento->Moto->matricula }}</td>
                            <td>
                                @if(isset($mantenimiento->kilometraje))
                                    {{ $mantenimiento->kilometraje }}km
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->kmRuedaTrasera))
                                    {{ $mantenimiento->kmRuedaTrasera }}km
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->kmRuedaDelantera))
                                    {{ $mantenimiento->kmRuedaDelantera }}km
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->fechaVencimientoSeguro))
                                    {{ \Carbon\Carbon::parse($mantenimiento->fechaVencimientoSeguro)->format('d/m/Y') }}
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->fechaVencimientoITV))
                                    {{ \Carbon\Carbon::parse($mantenimiento->fechaVencimientoITV)->format('d/m/Y') }}
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->kmAceiteMotor))
                                    {{ $mantenimiento->kmAceiteMotor }}km
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->kmReglajeValvulas))
                                    {{ $mantenimiento->kmReglajeValvulas }}km
                                @else
                                N/D
                                @endif
                            </td>
                    
                            <td>
                                @if(isset($mantenimiento->gastosGeneral))
                                    {{ $mantenimiento->gastosGeneral }}€
                                @else
                                N/D
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        <button type="button" class="btn btn-danger btn-sm" id="deleteSelectedMantenimientos" disabled>Eliminar seleccionados</button>
        </form>
        @else
            <br>
            <p>No hay mantenimientos registrados</p>
        @endif
        <br><br>
        <!--Paginacion de las tablas-->
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
    //script de la ventana de sweetalert
    $(document).ready(function () {
        $("#deleteSelectedMantenimientos").on("click", function () {
            var selectedMantenimientos = [];
            $("input[name='selectedMantenimientos[]']:checked").each(function () {
                var mantID = $(this).val();
                var motoMarcaModelo = $(this).closest("tr").find("td:eq(1)").text();

                selectedMantenimientos.push({ id: mantID, marcaModelo: motoMarcaModelo});
            });

            Swal.fire({
                title: "Confirma la eliminación",
                html: "Vas a eliminar los siguientes mantenimientos:<br><br>" +
                selectedMantenimientos.map(moto => `<b>ID:</b> ${moto.id} || ${moto.marcaModelo}`).join("<br>"),
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
        $("input[name='selectedMantenimientos[]']").on("change", function () {
            var numSelected = $("input[name='selectedMantenimientos[]']:checked").length;
            $("#deleteSelectedMantenimientos").prop("disabled", numSelected === 0);
        });
    });
</script>

@endsection