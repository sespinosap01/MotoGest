@extends('layouts.app')  

@section('content')
    <h1>Listado de Motos</h1>

    <ul>
        @foreach ($motos as $moto)
            <li>{{ $moto->marca }} - {{ $moto->modelo }}</li>
        @endforeach
    </ul>
@endsection
