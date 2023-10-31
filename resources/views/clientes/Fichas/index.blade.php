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
        <div class=" col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body text-center">
                    <h2 class="card-title">Kilometraje total</h2>
                    @if(isset($mantenimiento->kilometraje))
                    <h5 class="card-text">{{ $mantenimiento->kilometraje }} km</h5>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'kilometraje']) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar kilómetros">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class=" col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body text-center">
                    <h2 class="card-title">Gastos totales</h2>
                    @if(isset($mantenimiento->gastosGeneral))
                    <h5 class="card-text">{{ $mantenimiento->gastosGeneral }}€</h5>
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateKilometraje', ['idMoto' => $moto->idMoto, 'field' => 'gastosGeneral']) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoKilometraje"
                            placeholder="Modificar gastos">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Añadir kilómetros</h5>
                    <form action="{{ route('fichas.sumarKilometraje', ['idMoto' => $moto->idMoto]) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="kilometraje"
                            placeholder="Introduce los kilometros a sumar">
                        <button type="submit" class="btn btn-success">Sumar kilómetros</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Añadir gastos</h5>
                    <form action="{{ route('fichas.agregarGastos', ['idMoto' => $moto->idMoto]) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="sumarGastos"
                            placeholder="Introduce los gastos a sumar">
                        <button type="submit" class="btn btn-success">Sumar gastos</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title">Vencimiento de la ITV</h5>
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
                    <h5 class="card-title">Vencimiento del seguro</h5>
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
                    <h5 class="card-title">Fecha de la batería</h5>
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
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
                            placeholder="Modificar kilómetros">
                        <button type="submit" class="btn btn-sm btn-warning">Actualizar</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
    @endsection
