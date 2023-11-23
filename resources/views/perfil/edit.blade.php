@extends('layouts.app')

@section('content')
<script>
    $(document).ready(function() {
    $('#show-password').change(function() {
        if ($(this).is(':checked')) {
            $('#password').attr('type', 'text');
        } else {
            $('#password').attr('type', 'password');
        }
    });
});
</script>

<div class="container" data-aos="fade-up">
    <h1><i class="fa-solid fa-user-pen" style="color: #c65f20;"></i> Editar Perfil</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ route('profile.update', $user->idUsuario) }}">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre</label>
                    <div class="col-md-6">
                        <input id="nombre" type="text" class="form-control"
                            name="nombre" required autocomplete="nombre" autofocus @isset($user) value="{{$user->nombre}}" @endisset
                            pattern="[A-Za-zñÑáéíóúÁÉÍÓÚüÜ\s]+">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo electrónico</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control"
                        name="email" @isset($user) value="{{$user->email}}" @endisset required autocomplete="email" disabled>

                        <input type="hidden" name="email" value="{{$user->email}}">

                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center">
                            <input id="password" type="password" class="form-control" name="password" required autocomplete="new-password" pattern=".{8,}" title="La contraseña debe tener al menos 8 caracteres">
                            <div class="form-check ms-2 mt-2">
                                <input type="checkbox" class="form-check-input" id="show-password">
                                <label class="form-check-label" for="show-password"><i class="fa-solid fa-eye"></i></label>
                            </div>
                        </div>
                    </div>
                </div>                         

                <div class="row mb-3">
                    <label for="fechaNacimiento" class="col-md-4 col-form-label text-md-end">Fecha de
                        Nacimiento</label>
                    <div class="col-md-6">
                        <input id="fechaNacimiento" type="date" class="form-control" name="fechaNacimiento"
                            name="fechaNacimiento" @isset($user) value="{{$user->fechaNacimiento}}" @endisset required
                            autocomplete="fechaNacimiento" autofocus required  oninput="limitarLongitud(this, 10)">                   
                            @if ($errors->has('fechaNacimiento'))
                                <span style="color: red;">{{ $errors->first('fechaNacimiento') }}</span>
                            @endif                        
                    </div>                    
                </div>

                <div class="row mb-3">
                    <label for="numTelefono" class="col-md-4 col-form-label text-md-end">Teléfono</label>
                    <div class="col-md-6">
                        <input id="numTelefono" type="number" class="form-control @error('numTelefono') is-invalid @enderror" name="numTelefono"
                            @isset($user) value="{{$user->numTelefono}}" @endisset required autocomplete="numTelefono" autofocus 
                            oninput="limitarLongitud(this, 9)">
                    </div>
                </div>
      
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn text-white btn-sm" style="background-color: #c65f20;">
                            Editar perfil
                        </button>
                        <a href="/home" class="btn btn-sm btn-secondary" >Cancelar</a>
                        <br><br>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$user->idUsuario}}">Eliminar perfil</button> 

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal de confirmación de eliminación -->
<div class="modal top fade" data-mdb-backdrop="false" id="confirmDeleteModal{{$user->idUsuario}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b>Confirmar eliminación</b></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas <b>eliminar tu cuenta</b>? Esta accion es <b style="color: red">IRREVERSIBLE</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form action="{{ route('profile.destroy', $user->idUsuario) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

