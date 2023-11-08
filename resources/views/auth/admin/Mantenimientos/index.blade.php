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

        $("#th-id, #th-moto").on("click", function () {
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
                <h1><i class="fa-solid fa-wrench" style="color: #c65f20;"></i> Gestionar Mantenimientos</h1>
            </div>
            <div class="col-6 text-right">
                <h4>Registros:{{$totalMantenimientos}}</h4>
            </div>
        </div>

        @if(count($mantenimientos) > 0)
        <form action="{{ route('mantenimientos.deleteMultiple') }}" method="post">
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
                        <th>Acciones</th>
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
                            <td>
                                <div class="d-flex gap-3">
                                    <a class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$mantenimiento->idMantenimiento}}"><i class="fa-regular fa-trash-can"></i></a> 
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <button type="submit" class="btn btn-danger btn-sm">Eliminar seleccionados</button>
        </form>
        @else
            <br>
            <p>No hay mantenimientos registrados</p>
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