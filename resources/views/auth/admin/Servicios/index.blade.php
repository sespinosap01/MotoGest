@extends('layouts.app')

@section('content')
<div class="container">

@if(Auth::user()->rol->name == "User")
<p>No tienes acceso a esta página</p>
<a href="/home">Volver</a>
@endif
@if(Auth::user()->rol->name == "Admin")
    <h1>Gestionar Servicios</h1>
   <div style="    display: flex;
   gap: 50px;
   flex-wrap: wrap;
   justify-content: center;">
            @foreach ($servicios as $servicio)

            <div class="card p-2">
                <div class="card-header"><b>{{ $servicio->tipoServicio }} || {{ $servicio->estadoServicio }} || ID Moto: {{ $servicio->idMoto }}</b></div>
                <p><b>Descripcion: </b>{{ $servicio->descripcion }}</p>
                <p><b>Fecha Solicitada: </b>{{ $servicio->fechaSolicitada }}</p>
                <p><b>Fecha de inicio: </b> @if ($servicio->fechaInicioServicio == null)
                                            No se ha iniciado el servicio
                                            @endif
                                            {{ $servicio->fechaInicioServicio }}                
                </p>
                <p><b>Fecha de fin: </b> @if ($servicio->fechaFinServicio == null)
                                            El servicio no ha finalizado
                                            @endif
                                            {{ $servicio->fechaFinServicio }}     
                </p>  
                <p><b>Hora Solicitada: </b>{{ $servicio->horaServicio }}</p>
            </div>
            @endforeach
        </div>

    @endif
</div>

@endsection
