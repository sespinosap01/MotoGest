<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{!! asset('images/logo/logo.png') !!}">

    <title>MotoGest</title>

    <!-- Bootstrap -->
   

<style>
    .welcomeImg{
        
        width: 100%
    }
</style>

</head>

<body class="antialiased">
    <div class="container"">
        @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
            <h3><a href="{{ url('/home') }}">MotoGest</a></h3>
            @else
            <h3><a href="{{ route('login') }}">Iniciar Sesión</a></h3>

            @if (Route::has('register'))
            <h3> <a href="{{ route('register') }}">Registrarse</a></h3>
            @endif
            @endauth
        </div>
        @endif

        <img class="welcomeImg" src="{!! asset('images/varios/welcome.jpg') !!}">

    </div>


</body>

</html>
