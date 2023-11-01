@extends('layouts.app')

@section('content')
<style>
    .transition {
        transition: box-shadow 0.3s ease, transform 0.3s ease;
    }

    .transition:hover {
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.3);
        transform: translate(0, -5px);
    }
</style>


<div class="container ">
    <h1 class="mb-3"><i class="fa-solid fa-motorcycle" style="color: #c65f20;"></i> {{$moto->marca}} {{$moto->modelo}}
    </h1>
    <div class="row d-flex justify-content-around">
        <div class="col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body text-center">
                    <h2 class="card-title"><i class="fa-solid fa-gauge" style="color: #c65f20;"></i> Kilometraje del tacómetro</h2>
                    @if(isset($mantenimiento->kilometraje))
                    <p><h5 class="card-text">{{ $mantenimiento->kilometraje }} km</h5></p>
                    @else
                    <p><h5 class="card-text">No hay datos registrados</h5></p>
                    @endif
                    <button type="button" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#modalForm">
                        Modificar Kilómetros
                    </button>
                </div>
            </div>
        </div>
        <div class=" col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body text-center">
                    <h2 class="card-title"><i class="fa-solid fa-money-bills" style="color: #c65f20;"></i> Gastos totales</h2>
                    @if(isset($mantenimiento->gastosGeneral))
                    <p><h5 class="card-text">{{ $mantenimiento->gastosGeneral }}€</h5></p>
                    @else
                    <p><h5 class="card-text">No hay datos registrados</h5></p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'gastosGeneral']) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                             hidden oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-secondary">Reestablecer</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-plus" style="color: #c65f20;"></i> Añadir kilómetros</h5>
                    <form action="{{ route('fichas.sumarKilometraje', ['idMoto' => $moto->idMoto]) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="kilometraje" placeholder="Introduce los kilómetros a sumar" oninput="limitarLongitud(this, 9)">

                        <button type="submit" class="btn btn-success btn-sm">Sumar kilómetros</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-coins" style="color: #c65f20;"></i> Añadir gastos</h5>
                    <form action="{{ route('fichas.agregarGastos', ['idMoto' => $moto->idMoto]) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="sumarGastos"
                            placeholder="Introduce los gastos a sumar" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-success btn-sm">Sumar gastos</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-calendar" style="color: #c65f20;"></i> Vencimiento de la ITV</h5>
                    @if(isset($mantenimiento->fechaVencimientoITV))
                    {{ \Carbon\Carbon::parse($mantenimiento->fechaVencimientoITV)->format('d/m/Y') }}
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'fechaVencimientoITV']) }}" method="POST">
                        @csrf
                        <input type="date" class="form-control mb-3" name="nuevoKilometraje">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-regular fa-calendar" style="color: #c65f20;"></i> Vencimiento del seguro</h5>
                    @if(isset($mantenimiento->fechaVencimientoSeguro))
                    {{ \Carbon\Carbon::parse($mantenimiento->fechaVencimientoSeguro)->format('d/m/Y') }}
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'fechaVencimientoSeguro']) }}" method="POST">
                        @csrf
                        <input type="date" class="form-control mb-3" name="nuevoKilometraje">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-calendar-days" style="color: #c65f20;"></i> Fecha de la batería</h5>
                    @if(isset($mantenimiento->fechaBateria))
                    {{ \Carbon\Carbon::parse($mantenimiento->fechaBateria)->format('d/m/Y') }}
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'fechaBateria']) }}" method="POST">
                    @csrf
                    <input type="date" class="form-control mb-3" name="nuevoKilometraje">
                    <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Aceite del motor</h5>
                    @if(isset($mantenimiento->kmAceiteMotor))
                    <p class="card-text">{{ $mantenimiento->kmAceiteMotor }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmAceiteMotor']) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Rueda trasera</h5>
                    @if(isset($mantenimiento->kmRuedaTrasera))
                    <p class="card-text">{{ $mantenimiento->kmRuedaTrasera }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmRuedaTrasera']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Rueda delantera</h5>
                    @if(isset($mantenimiento->kmRuedaDelantera))
                    <p class="card-text">{{ $mantenimiento->kmRuedaDelantera }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmRuedaDelantera']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Pastillas de freno delantero</h5>
                    @if(isset($mantenimiento->kmPastillaFrenoDelantero))
                    <p class="card-text">{{ $mantenimiento->kmPastillaFrenoDelantero }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmPastillaFrenoDelantero']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Pastillas de freno trasero</h5>
                    @if(isset($mantenimiento->kmPastillaFrenoTrasero))
                    <p class="card-text">{{ $mantenimiento->kmPastillaFrenoTrasero }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmPastillaFrenoTrasero']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Reglaje de válvulas</h5>
                    @if(isset($mantenimiento->kmReglajeValvulas))
                    <p class="card-text">{{ $mantenimiento->kmReglajeValvulas }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmReglajeValvulas']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class ="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Cadena</h5>
                    @if(isset($mantenimiento->kmCadena))
                    <p class="card-text">{{ $mantenimiento->kmCadena }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmCadena']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Retenes de la horquilla</h5>
                    @if(isset($mantenimiento->kmRetenesHorquilla))
                    <p class="card-text">{{ $mantenimiento->kmRetenesHorquilla }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmRetenesHorquilla']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Kit de transmisión</h5>
                    @if(isset($mantenimiento->kmKitTransmision))
                    <p class="card-text">{{ $mantenimiento->kmKitTransmision }} km</p>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kmKitTransmision']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

    <!--Modal para kilometraje-->
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalFormLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormLabel">Modificar Kilometraje</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kilometraje']) }}" method="POST">
                        @csrf
                        <p>Vas a <b>modificar</b> el kilometraje del tacómetro, si introduces más kilómetros de los 
                        que tenías anteriormente <b>no se sumarán</b> a las otras piezas de la moto. <b>Si quieres sumar</b> kilómetros
                        tanto al tacómetro como a todas las piezas, deberas usar la opcion <b><i>"Añadir kilómetros"</i></b></p>
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje" value="{{ $mantenimiento->kilometraje }}" placeholder="Introduce los kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
