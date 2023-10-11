<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{!! asset('images/logo/logo.png') !!}">

    <title>MotoGest</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300&display=swap');
        *{
            font-family: 'Sora', sans-serif;
                }
    </style>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<style>
    .welcomeImg{        
        width: 100%;
        margin: 0;
        padding: 0;
    }
</style>

</head>

<body>
    <div>
        @if (Route::has('login'))
        <div>
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
