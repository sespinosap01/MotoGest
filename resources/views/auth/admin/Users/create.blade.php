@extends('layouts.app')

@section('content')
<script>
//funcion ajax para validar que el correo electrónico no esté en uso
function validateEmail() {
    var email = $('#email').val();

    $.get('/admin/checkEmail', { email: email }, function(data) {
        if (data.exists) {
            $('#msgErrorEmail').text('El correo electrónico ya está registrado').show();
            $('#crearUsuario').prop('disabled', true);
            $('#email').addClass('is-invalid');
        } else {
            $('#msgErrorEmail').text('').hide();
            $('#crearUsuario').prop('disabled', false);
            $('#email').removeClass('is-invalid');
        }
    });
}


</script>
<div class="container" data-aos="fade-up">

    @if(Auth::user()->rol->name == "User")
    <div class="alert alert-danger mt-3">
        <p>No tienes acceso a esta página</p>
        <a href="/home" class="btn btn-sm btn-dark">Volver</a>
    </div>
    @endif

    @if(Auth::user()->rol->name == "Admin")
    <h1><i class="fa-solid fa-user" style="color: #c65f20;"></i> Crear usuario</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus placeholder="Ej: Pedro López">

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
                        value="{{ old('email') }}" required autocomplete="email" placeholder="Ej: micorreo@gmail.com" oninput="validateEmail()">
                        <span class="invalid-feedback" role="alert" id="msgErrorEmail"></span>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" placeholder="Introduce la contraseña">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>Las contraseñas no coinciden o son inferiores a 8 caracteres</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="fechaNacimiento" class="col-md-4 col-form-label text-md-end">Fecha de
                        Nacimiento</label>
                    <div class="col-md-6">
                        <input id="fechaNacimiento" type="date" class="form-control" name="fechaNacimiento"
                            name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required
                            autocomplete="fechaNacimiento" autofocus required oninput="limitarLongitud(this, 10)">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="numTelefono" class="col-md-4 col-form-label text-md-end">Teléfono</label>
                    <div class="col-md-6">
                        <input id="numTelefono" type="number"
                            class="form-control @error('numTelefono') is-invalid @enderror" name="numTelefono"
                            value="{{ old('numTelefono') }}" required autocomplete="numTelefono" autofocus placeholder="Ej: 654321098" oninput="limitarLongitud(this, 9)">

                        @error('numTelefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>El numero de telefono debe tener 9 caracteres</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="rol_id" class="col-md-4 col-form-label text-md-end">Rol</label>
                    <div class="col-md-6">
                        <select name="rol_id" id="rol_id" class="form-control">
                            <option value="1">Selecciona el rol</option>
                            @foreach ($roles as $rol)
                            <option value="{{$rol->id}}">{{$rol->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" id="crearUsuario" class="btn btn-sm text-white" style="background-color: #c65f20;">
                            Crear usuario
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-sm btn-secondary" >Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
        @endif
</div>
@endsection
