@extends('layouts.app')

@section('content')
<div class="container" data-aos="fade-up">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Registrarse</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="nombre" value="{{ old('nombre') }}" required autocomplete="nombre" autofocus  placeholder="Ej: Pedro López">

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">Correo electrónico</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Ej: micorreo@gmail.com">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Este correo electrónico ya está en uso</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password" placeholder="Introduce la contraseña">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Las contraseñas no coinciden o son inferiores a 8 caracteres</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm"
                                class="col-md-4 col-form-label text-md-end">Confirma la contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" 
                                    name="password_confirmation" required autocomplete="new-password" placeholder="Confirma la contraseña">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="fechaNacimiento" class="col-md-4 col-form-label text-md-end">Fecha de nacimiento</label>
                            <div class="col-md-6">
                                <input id="fechaNacimiento" type="date" class="form-control @error('fechaNacimiento') is-invalid @enderror"
                                    name="fechaNacimiento" value="{{ old('fechaNacimiento') }}" required autocomplete="fechaNacimiento" autofocus  oninput="limitarLongitud(this, 10)">

                                @error('fechaNacimiento')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debes ser mayor de 15 años</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-3">
                            <label for="numTelefono" class="col-md-4 col-form-label text-md-end">Teléfono</label>
                            <div class="col-md-6">
                                <input id="numTelefono" type="number" class="form-control @error('numTelefono') is-invalid @enderror"
                                    name="numTelefono" value="{{ old('numTelefono') }}" required autocomplete="numTelefono" autofocus placeholder="Ej: 654321098" oninput="limitarLongitud(this, 9)">

                                @error('numTelefono')
                                <span class="invalid-feedback" role="alert">
                                    <strong>El numero de teléfono debe tener 9 caracteres</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="politicaPrivacidad"
                                           id="politicaPrivacidad" required>
                                    <label class="form-check-label" for="politicaPrivacidad">
                                        Acepto la <a href="{{ asset('documents/politicaPrivacidad.pdf') }}" target="_blank" style="text-decoration: none;">política de privacidad y
                                        </a> y he leido el <a href="{{ asset('documents/avisoLegal.pdf') }}" target="_blank" style="text-decoration: none;">aviso legal </a>.
                                    </label>
                                </div>
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn text-white" style="background-color: #c65f20;">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
