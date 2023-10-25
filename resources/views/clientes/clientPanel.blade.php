@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
    <div class="row">
        <div class="row mb-3">
            <h1>Mis Motos</h1>
            <div class="col-10">
                <a href="{{ route('motopanel.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Crear nueva moto</a>
            </div>
        </div>        @foreach ($motos as $moto)
        <div class="col-md-4">
            <div class="card mb-4" style="width: 83%;">
                <img src="{{ asset('images/iconos/motoDefault.png') }}" class="card-img-top img-thumbnail" alt="Imagen de la moto" style="max-width: 100%; height: auto;">
                <div class="card-body">
                    <h3 class="card-title">{{ $moto->marca }} {{ $moto->modelo }}</h3>
                    <p class="card-text">{{ $moto->cilindrada }} cc</p>
                    <p class="card-text">{{ $moto->potencia }} cv</p>
                    <p class="card-text">{{ $moto->fechaFabricacion }}</p>
                    <p class="card-text">{{ $moto->matricula }}</p>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$moto->idMoto}}">Eliminar</button>                     
                </div>
            </div>
        </div>
        @endforeach
    </div>
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
                ¿Estás seguro de que deseas eliminar tu {{$moto->marca}} {{$moto->modelo}}</b>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('motopanel.destroy', $moto->idMoto) }}" method="POST">
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
