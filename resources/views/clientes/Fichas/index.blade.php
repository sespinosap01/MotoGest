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

    progress {
        width: 100px;
        height: 8px;
        border: 2px solid gray;
        border-radius: 10px;

    }

    .progressVerde::-webkit-progress-value {
        background-color: #6fb86f;
        border-radius: 10px;
    }

    .progressAmarillo::-webkit-progress-value {
        background-color: #FFC107;
        border-radius: 10px;
    }

    .progressRojo::-webkit-progress-value {
        background-color: #ff0000bc;
        border-radius: 10px;
    }

    .progressNegro::-webkit-progress-value {
        background-color:#212529;
        border-radius: 10px;
    }

    hr{
        height: 3px;
        position: relative;
        margin: 30px auto;
        background: black;
    }
    .pointer{
        cursor: pointer;
    }

    @keyframes latidos {
    from { transform: none; }
    50% { transform: scale(1.2); }
    to { transform: none; }
    }

    .latidoInfo {
    display: inline-block;
    animation: latidos 3s infinite;
    transform-origin: center;
    }

</style>


<div class="container">
    <div class="row">
        <div class="col-6 text-left">
            <h1 class="mb-3"><i class="fa-solid fa-motorcycle" style="color: #c65f20;"></i> {{$moto->marca}} {{$moto->modelo}}</h1>    
        </div>
        <div class="col-6 text-right" >
            <a type="button" data-toggle="modal" data-target="#modalInfo">
                <h4><i class="fa-solid fa-circle-info fa-2xl pointer latidoInfo" ></i></h4>
            </a>
        </div>
    </div>
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
                        <i class="fa-solid fa-pen-to-square"></i> Modificar Kilómetros
                    </button>
                </div>
            </div>
        </div>
        <div class=" col-md-6 mb-4">
            <div class="card shadow transition">
                <div class="card-body text-center">
                    <h2 class="card-title"><i class="fa-solid fa-money-bills" style="color: #c65f20;"></i> Gastos</h2>
                    @if(isset($mantenimiento->gastosGeneral))
                    <p><h5 class="card-text">{{ $mantenimiento->gastosGeneral }}€</h5></p>
                    @else
                    <p><h5 class="card-text">No hay datos registrados</h5></p>
                    @endif
                    <form action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'gastosGeneral']) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                              oninput="limitarLongitud(this, 9)" hidden>
                              <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
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
                        <input type="number" class="form-control mb-3" name="kilometraje" 
                        placeholder="Introduce los kilómetros a sumar" oninput="limitarLongitud(this, 9)" required>
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
                            placeholder="Introduce los gastos a sumar" oninput="limitarLongitud(this, 9)" required>
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
                    @php
                        $fechaVencimientoITV = \Carbon\Carbon::parse($mantenimiento->fechaVencimientoITV);
                        $fechaActual = now();
                        $diasRestantes = $fechaActual->diffInDays($fechaVencimientoITV);
                    @endphp

                    @if ($fechaActual > $fechaVencimientoITV)
                        <p>{{ $fechaVencimientoITV->format('d/m/Y') }}</p>
                        <p style="color: red;"><i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Tienes caducada la ITV de tu moto!</p>
                    @elseif ($diasRestantes == 0)
                        <p>{{ $fechaVencimientoITV->format('d/m/Y') }}</p>
                        <p style="color: #ff6600;"><i class="fa-solid fa-triangle-exclamation" style="color: #ff6600;"></i> ¡La ITV de tu moto caduca mañana!</p>
                    @elseif ($diasRestantes < 50)
                        <p>{{ $fechaVencimientoITV->format('d/m/Y') }}</p>
                        <p style="color: #ff6600;"><i class="fa-solid fa-triangle-exclamation" style="color: #ff6600;"></i> ¡Solo quedan {{ $diasRestantes }} días para que caduque tu ITV!</p>
                    @else
                        <p>{{ $fechaVencimientoITV->format('d/m/Y') }}</p>
                        <p>Tu ITV caduca en {{ $diasRestantes }} días</p>
                    @endif
                @else
                    <p class="card-text">No hay datos registrados</p>
                @endif                
                    <form action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'fechaVencimientoITV']) }}" method="POST">
                        @csrf
                        <input type="date" class="form-control mb-3" name="fechas">
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-regular fa-calendar" style="color: #c65f20;"></i> Vencimiento del seguro</h5>
                    @if(isset($mantenimiento->fechaVencimientoSeguro))
                    @php
                        $fechaVencimientoSeguro = \Carbon\Carbon::parse($mantenimiento->fechaVencimientoSeguro);
                        $fechaActual = now();
                        $diasRestantesSeguro = $fechaActual->diffInDays($fechaVencimientoSeguro);
                    @endphp
    
                    @if ($fechaActual > $fechaVencimientoSeguro)
                        <p>{{ $fechaVencimientoSeguro->format('d/m/Y') }}</p>
                        <p style="color: red;"><i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Tu seguro está caducado!</p>
                    @elseif ($diasRestantesSeguro == 0)
                        <p>{{ $fechaVencimientoSeguro->format('d/m/Y') }}</p>
                        <p style="color: #ff6600;"><i class="fa-solid fa-triangle-exclamation" style="color: #ff6600;"></i> ¡Tu seguro caduca mañana!</p>
                    @elseif ($diasRestantesSeguro < 50)
                        <p>{{ $fechaVencimientoSeguro->format('d/m/Y') }}</p>
                        <p style="color: #ff6600;"><i class="fa-solid fa-triangle-exclamation" style="color: #ff6600;"></i> ¡Solo quedan {{ $diasRestantesSeguro }} días para que caduque tu seguro!</p>
                    @else
                        <p>{{ $fechaVencimientoSeguro->format('d/m/Y') }}</p>
                        <p>Tu seguro caduca en {{ $diasRestantesSeguro }} días</p>
                    @endif
                @else
                    <p class="card-text">No hay datos registrados</p>
                @endif
                    <form action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'fechaVencimientoSeguro']) }}" method="POST">
                        @csrf
                        <input type="date" class="form-control mb-3" name="fechas">
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-calendar-days" style="color: #c65f20;"></i> Fecha de la batería</h5>
                    @if(isset($mantenimiento->fechaBateria))
                        @php
                            $fechaBateria = \Carbon\Carbon::parse($mantenimiento->fechaBateria);
                            $diasDesdeCambio = $fechaBateria->diffInDays(\Carbon\Carbon::now());
                            $fechaActual = (\Carbon\Carbon::now());
                        @endphp
                        
                        <p>{{ $fechaBateria->format('d/m/Y') }}</p>

                        @if ($fechaActual < $fechaBateria)
                        <p class="card-text">Has introducido una fecha futura</p>
                        @elseif($diasDesdeCambio == 0)
                        <p class="card-text">La batería se ha cambiado hoy</p>
                        @elseif ($diasDesdeCambio == 1)
                        <p class="card-text">La batería se cambió ayer</p>
                        @else
                        <p class="card-text">Cambiaste la batería hace {{ $diasDesdeCambio }} días </p>
                        @endif
                    @else
                        <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'fechaBateria']) }}" method="POST">
                        @csrf
                        <input type="date" class="form-control mb-3" name="fechas">
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <hr class="mt-3 mb-4 w-75">
        <div class="row mb-4">
            <div class="col-12">
                <div class="row">
                    <div class="col-6 text-left">
                        <h1>Kilometrajes</h1>                    
                    </div>
                    <div class="col-6 text-right" >
                        <a type="button" data-toggle="modal" data-target="#modalInfoKM">
                            <h4><i class="fa-solid fa-circle-info fa-2xl pointer latidoInfo" ></i></h4>
                        </a>
                    </div>
                </div>
                    <button type="button"  class="btn btn-sm btn-warning transition" data-toggle="modal" data-target="#kmUpdateModal">
                    <i class="fa-solid fa-pen-to-square"></i> 
                    Modificar kilometrajes
                </button>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-oil-can" style="color: #c65f20;"></i> Aceite del motor</h5>
                    @if(isset($mantenimiento->kmAceiteMotor))
                    <p class="card-text">{{ $mantenimiento->kmAceiteMotor }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmAceiteMotor <=4500)
                        class="progressVerde"
                        @elseif($mantenimiento->kmAceiteMotor <=6000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmAceiteMotor <=6500)
                        class="progressRojo"
                        @elseif($mantenimiento->kmAceiteMotor >6500)
                        class="progressNegro"
                        @endif
                        max="6500" value="{{ $mantenimiento->kmAceiteMotor }}">
                        </progress> 6500 km</p>
                        @if($mantenimiento->kmAceiteMotor >6500)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmAceiteMotor']) }}" method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                        <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-person-biking" style="color: #c65f20;"></i> Neumático trasero</h5>
                    @if(isset($mantenimiento->kmRuedaTrasera))
                    <p class="card-text">{{ $mantenimiento->kmRuedaTrasera }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmRuedaTrasera <=5000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmRuedaTrasera <=6000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmRuedaTrasera <=7000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmRuedaTrasera >7000)
                        class="progressNegro"
                        @endif
                        max="7000" value="{{ $mantenimiento->kmRuedaTrasera }}">
                        </progress> 7000 km</p>
                        @if($mantenimiento->kmRuedaTrasera >7000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif
                    @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmRuedaTrasera']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-person-biking" style="color: #c65f20;"></i> Neumático delantero</h5>
                    @if(isset($mantenimiento->kmRuedaDelantera))
                    <p class="card-text">{{ $mantenimiento->kmRuedaDelantera }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmRuedaDelantera <=6000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmRuedaDelantera <=7000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmRuedaDelantera <=9000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmRuedaDelantera >9000)
                        class="progressNegro"
                        @endif
                        max="9000" value="{{ $mantenimiento->kmRuedaDelantera }}">
                        </progress> 9000 km</p>
                        @if($mantenimiento->kmRuedaDelantera >9000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif                    
                        @else
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmRuedaDelantera']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-compact-disc" style="color: #c65f20;"></i> Pastillas de freno delantero</h5>
                    @if(isset($mantenimiento->kmPastillaFrenoDelantero))
                    <p class="card-text">{{ $mantenimiento->kmPastillaFrenoDelantero }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmPastillaFrenoDelantero <=8000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmPastillaFrenoDelantero <=9500)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmPastillaFrenoDelantero <=12000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmPastillaFrenoDelantero >12000)
                        class="progressNegro"
                        @endif
                        max="12000" value="{{ $mantenimiento->kmPastillaFrenoDelantero }}">
                        </progress> 12000 km</p>
                        @if($mantenimiento->kmPastillaFrenoDelantero >12000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif   
                        @else
                    </p>
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmPastillaFrenoDelantero']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-compact-disc" style="color: #c65f20;"></i> Pastillas de freno trasero</h5>
                    @if(isset($mantenimiento->kmPastillaFrenoTrasero))
                    <p class="card-text">{{ $mantenimiento->kmPastillaFrenoTrasero }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmPastillaFrenoTrasero <=10000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmPastillaFrenoTrasero <=12500)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmPastillaFrenoTrasero <=15000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmPastillaFrenoTrasero >15000)
                        class="progressNegro"
                        @endif
                        max="15000" value="{{ $mantenimiento->kmPastillaFrenoTrasero }}">
                        </progress> 15000 km</p>
                        @if($mantenimiento->kmPastillaFrenoTrasero >15000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif   
                        @else
                    </p>
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmPastillaFrenoTrasero']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-screwdriver-wrench" style="color: #c65f20;"></i> Reglaje de válvulas</h5>
                    @if(isset($mantenimiento->kmReglajeValvulas))
                    <p class="card-text">{{ $mantenimiento->kmReglajeValvulas }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmReglajeValvulas <=25000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmReglajeValvulas <=33000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmReglajeValvulas <=35000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmReglajeValvulas >35000)
                        class="progressNegro"
                        @endif
                        max="35000" value="{{ $mantenimiento->kmReglajeValvulas }}">
                        </progress> 35000 km</p>
                        @if($mantenimiento->kmReglajeValvulas >35000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif   
                        @else
                    </p>
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmReglajeValvulas']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class ="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-link" style="color: #c65f20;"></i> Cadena</h5>
                    @if(isset($mantenimiento->kmCadena))
                    <p class="card-text">{{ $mantenimiento->kmCadena }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmCadena <=25000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmCadena <=33000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmCadena <=35000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmCadena >35000)
                        class="progressNegro"
                        @endif
                        max="35000" value="{{ $mantenimiento->kmCadena }}">
                        </progress> 35000 km</p>
                        @if($mantenimiento->kmCadena >35000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif   
                        @else
                    </p>
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmCadena']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-heading" style="color: #c65f20;"></i> Retenes de la horquilla</h5>
                    @if(isset($mantenimiento->kmRetenesHorquilla))
                    <p class="card-text">{{ $mantenimiento->kmRetenesHorquilla }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmRetenesHorquilla <=25000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmRetenesHorquilla <=33000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmRetenesHorquilla <=35000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmRetenesHorquilla >35000)
                        class="progressNegro"
                        @endif
                        max="35000" value="{{ $mantenimiento->kmRetenesHorquilla }}">
                        </progress> 35000 km</p>
                        @if($mantenimiento->kmRetenesHorquilla >35000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif   
                        @else
                    </p>
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmRetenesHorquilla']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow transition">
                <div class="card-body">
                    <h5 class="card-title"><i class="fa-solid fa-screwdriver" style="color: #c65f20;"></i> Kit de transmisión</h5>
                    @if(isset($mantenimiento->kmKitTransmision))
                    <p class="card-text">{{ $mantenimiento->kmKitTransmision }} km 
                        <progress id="file" 
                        @if($mantenimiento->kmKitTransmision <=18000)
                        class="progressVerde"
                        @elseif($mantenimiento->kmKitTransmision <=20000)
                        class="progressAmarillo"
                        @elseif($mantenimiento->kmKitTransmision <=25000)
                        class="progressRojo"
                        @elseif($mantenimiento->kmKitTransmision >25000)
                        class="progressNegro"
                        @endif
                        max="25000" value="{{ $mantenimiento->kmKitTransmision }}">
                        </progress> 25000 km</p>
                        @if($mantenimiento->kmKitTransmision >25000)
                        <p style="color: red"> <i class="fa-solid fa-triangle-exclamation" style="color: red;"></i> ¡Has superado el kilometraje recomendado!</p>
                        @endif   
                        @else
                    </p>
                    <p class="card-text">No hay datos registrados</p>
                    @endif
                    <form
                        action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kmKitTransmision']) }}"
                        method="POST">
                        @csrf
                        <input type="number" class="form-control mb-3" name="nuevoCampo"
                            placeholder="Modificar kilómetros" oninput="limitarLongitud(this, 9)" hidden>
                            <button type="submit" class="btn btn-sm btn-dark"><i class="fa-solid fa-brush"></i> Reestablecer</button>
                        </form>
                </div>
            </div>

        </div>
    </div> 

    <!--Modal para modificar tacometro-->
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
                    <form action="{{ route('fichas.updateCampos', ['idMoto' => $moto->idMoto, 'field' => 'kilometraje']) }}" method="POST">
                        @csrf
                        <p>Vas a <b>modificar</b> el kilometraje del tacómetro, si introduces más kilómetros de los 
                        que tenías anteriormente <b>no se sumarán</b> a los otros apartados del mantenimiendo de la moto. <b>Si quieres sumar</b> kilómetros
                        tanto al tacómetro como a todos los apartados, deberás usar la opcion <b><i>"Añadir kilómetros"</i></b></p>
                        <input type="number" class="form-control mb-3" name="nuevoCampo" value="{{ $mantenimiento->kilometraje }}" placeholder="Introduce los kilómetros" oninput="limitarLongitud(this, 9)">
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Modal de modificar kilometros-->
    <div class="modal fade" id="kmUpdateModal" tabindex="-1" role="dialog" aria-labelledby="kmUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="kmUpdateModalLabel"><i class="fa-solid fa-pen-to-square" style="color: #c65f20"></i> Modificar kilometrajes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('fichas.updateKilometrajeMultiple', ['idMoto' => $moto->idMoto]) }}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kmAceiteMotor"><i class="fa-solid fa-oil-can" style="color: #c65f20;"></i> Aceite del motor</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmAceiteMotor" value="{{ $mantenimiento->kmAceiteMotor }}" oninput="limitarLongitud(this, 9)">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kmRuedaTrasera"><i class="fa-solid fa-person-biking" style="color: #c65f20;"></i> Neumático trasero</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmRuedaTrasera" value="{{ $mantenimiento->kmRuedaTrasera }}" oninput="limitarLongitud(this, 9)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kmRuedaDelantera"><i class="fa-solid fa-person-biking" style="color: #c65f20;"></i> Neumático delantero</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmRuedaDelantera" value="{{ $mantenimiento->kmRuedaDelantera }}" oninput="limitarLongitud(this, 9)">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kmPastillaFrenoDelantero"><i class="fa-solid fa-compact-disc" style="color: #c65f20;"></i> Pastillas de freno delantero</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmPastillaFrenoDelantero" value="{{ $mantenimiento->kmPastillaFrenoDelantero }}" oninput="limitarLongitud(this, 9)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kmPastillaFrenoTrasero"><i class="fa-solid fa-compact-disc" style="color: #c65f20;"></i> Pastillas de freno trasero</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmPastillaFrenoTrasero" value="{{ $mantenimiento->kmPastillaFrenoTrasero }}" oninput="limitarLongitud(this, 9)">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kmReglajeValvulas"><i class="fa-solid fa-screwdriver-wrench" style="color: #c65f20;"></i> Reglaje de válvulas</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmReglajeValvulas" value="{{ $mantenimiento->kmReglajeValvulas }}" oninput="limitarLongitud(this, 9)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kmCadena"><i class="fa-solid fa-link" style="color: #c65f20;"></i> Cadena</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmCadena" value="{{ $mantenimiento->kmCadena }}" oninput="limitarLongitud(this, 9)">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="kmRetenesHorquilla"><i class="fa-solid fa-heading" style="color: #c65f20;"></i> Retenes de la horquilla</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmRetenesHorquilla" value="{{ $mantenimiento->kmRetenesHorquilla }}" oninput="limitarLongitud(this, 9)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="kmKitTransmision"><i class="fa-solid fa-screwdriver" style="color: #c65f20;"></i> Kit de transmisión</label>
                                <input type="number" class="form-control" placeholder="Introduce un kilometraje" name="kmKitTransmision" value="{{ $mantenimiento->kmKitTransmision }}" oninput="limitarLongitud(this, 9)">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-warning"><i class="fa-solid fa-pen-to-square"></i> Modificar</button>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!--Modal de info-->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="modalInfo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">¿Cómo Funciona?</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ¡Hola! Si es tu primera vez utilizando la aplicación, te sugerimos que revises la siguiente información:
              <br><br>
              <ul>
                <li>Para ajustar el kilometraje del tacómetro sin afectar otros aspectos de la moto, utiliza la primera 
                    carta de <i><b>"Kilometraje del tacómetro"</i></b>. Por ejemplo, si adquiriste una moto de segunda 
                    mano y necesitas introducir su información, podrás <b>actualizar solo el tacómetro</b> si el kilometraje entre piezas
                    es distinto y más tarde en el boton naranja de <i><b>"Modificar kilometrajes"</b></i>
                    podrás actualizar los otros kilometrajes.
                </li>
                <br>
                <li>Al hacer uso del boton <b><i>"Sumar kilómetros"</i></b> sumarás el kilometraje introducido tanto al tacómetro
                    como a todos los apartados de la moto. Esta opcion es ideal <b>si quieres introducir el kilometraje que has 
                    recorrido</b> a lo largo de una semana o saliendo de ruta.
                </li>
                <br>
                <li>Los gastos te permiten agregar costos específicos y llevar un control durante un periodo determinado.
                     <b>Tú tienes el control</b> y puedes reestablecerlos cuando quieras.
                </li>
                <br>
                <li>Introduce las fechas indicadas en las cartas y la aplicación <b>te avisará</b> cuando falten  
                    <b>menos de 50</b> días para el vencimiento de la ITV y o el seguro.
                </li>
              </ul>
              Agradecemos tu atención. Recuerda que si tienes alguna duda o alguna propuesta de mejora puedes
              contactar con nosotros en <a href="mailto:motogestsoporte@gmail.com" style="text-decoration: none;">este correo.</a>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn text-white btn-sm" style="background-color: #c65f20;" data-dismiss="modal"><i class="fa-regular fa-circle-check"></i> Entendido</button>
            </div>
          </div>
        </div>
    </div>

    <!--Modal de info KM-->
    <div class="modal fade" id="modalInfoKM" tabindex="-1" role="dialog" aria-labelledby="modalInfoKM" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Sobre los kilometrajes</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Información sobre como manejar los kilometrajes de tu moto:
              <br><br>
              <ul>
                <li>Si has realizado un mantenimiento simplemente actualiza su kilometraje a 0 o usa el boton de 
                    <i><b>"Reestablecer"</b></i> para volver a llevar el control de nuevo.
                </li>            
                <br>
                <li>Ten en cuenta que los <b>kilometrajes recomendados</b> para cada mantenimiento se establecen 
                    como norma general. <b>Pueden variar significativamente según tu moto y tu estilo de conducción</b>.
                    Es recomendable que te informes cómo funciona tu moto específica.
                </li>
              </ul>              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn text-white btn-sm" style="background-color: #c65f20;" data-dismiss="modal"><i class="fa-regular fa-circle-check"></i> Entendido</button>
            </div>
          </div>
        </div>
    </div>
    @endsection
