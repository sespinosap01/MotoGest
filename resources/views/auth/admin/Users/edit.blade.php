@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">

    @if(Auth::user()->rol->name == "User")
    <div class="alert alert-danger mt-3">
        <p>No tienes acceso a esta página</p>
        <a href="/home" class="btn btn-sm btn-dark">Volver</a>
    </div>
    @endif

    @if(Auth::user()->rol->name == "Admin")
    <h3><i class="fa-solid fa-user" style="color: #c65f20;"></i> Editando a <b>{{$user->nombre}}</b></h3>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('user.update', $user->idUsuario) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="nombre" required autocomplete="nombre" autofocus @isset($user) value="{{$user->nombre}}" @endisset>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>
                
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" 
                        @isset($user) value="{{$user->email}}" @endisset  required autocomplete="email" 
                        placeholder="Ej: micorreo@gmail.com" disabled>
                        
                        <input type="hidden" name="email" value="{{$user->email}}">
                    </div>
                </div>
                                    
                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>La contraseña es inferior a 8 caracteres</strong>
                        </span>
                        @enderror
                    </div>
                </div>            

                <div class="row mb-3">
                    <label for="fechaNacimiento" class="col-md-4 col-form-label text-md-end">Fecha de
                        Nacimiento</label>
                    <div class="col-md-6">
                        <input id="fechaNacimiento" type="date" class="form-control" name="fechaNacimiento"
                            name="fechaNacimiento" @isset($user) value="{{$user->fechaNacimiento}}" @endisset required
                            autocomplete="fechaNacimiento" autofocus required oninput="limitarLongitud(this, 10)">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="numTelefono" class="col-md-4 col-form-label text-md-end">Teléfono</label>
                    <div class="col-md-6">
                        <input id="numTelefono" type="number"
                            class="form-control" name="numTelefono"
                            @isset($user) value="{{$user->numTelefono}}" @endisset required autocomplete="numTelefono" autofocus oninput="limitarLongitud(this, 9)">                
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="rol_id" class="col-md-4 col-form-label text-md-end">Rol</label>
                    <div class="col-md-6">
                        <select name="rol_id" id="rol_id" class="form-control">
                            <option value="1">Selecciona el rol</option>
                            @foreach ($roles as $rol)
                            <option value="{{$rol->id}}" @if(isset($user) && $user->rol_id == $rol->id) selected @endif>
                                {{$rol->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" id="crearUsuario"  class="btn text-white btn-sm" style="background-color: #c65f20;">
                            Editar usuario
                        </button>
                        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary" >Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
        @endif
</div>
@endsection
