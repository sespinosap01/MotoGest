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
<div class="container" data-aos="fade-up">
    <div class="row">
        <div class="row mb-2">
            <div class="col-10">
                <h1>Mis Motos</h1>
            </div>
            <div class="col-2">
                <a href="{{ route('motopanel.create') }}" class="btn text-white btn-sm" style="background-color: #c65f20;">Añadir moto</a>
            </div>
        </div>    
        @if (count($motos) > 0)
        @foreach ($motos as $moto)
        <div class="col-md-4">
            <div class="card mb-4 shadow transition" style="width: 83%;">
                <img src="{{ asset('images/iconos/motoDefault.png') }}" class="card-img-top img-thumbnail" alt="Imagen de la moto" style="max-width: 100%; height: auto;">
                <div class="card-body">
                    <h3 class="card-title">{{ $moto->marca }} {{ $moto->modelo }}</h3>
                    <p class="card-text"><i class="fa-solid fa-gears" style="color: #c65f20;"></i> {{ $moto->cilindrada }} cc</p>
                    <p class="card-text"><i class="fa-solid fa-gauge" style="color: #c65f20;"></i> {{ $moto->potencia }} cv</p>
                    <p class="card-text"><i class="fa-solid fa-calendar-days" style="color: #c65f20;"></i> {{ $moto->fechaFabricacion }}</p>
                    <p class="card-text"><i class="fa-solid fa-ticket" style="color: #c65f20;"></i> {{ $moto->matricula }}</p>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('motopanel.edit', $moto->idMoto) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="" class="btn btn-success btn-sm">Mantenimientos</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$moto->idMoto}}">Eliminar</button>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <h5>No tienes motos registradas</h5>
        @endif

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
