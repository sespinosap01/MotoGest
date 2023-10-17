<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="{!! asset('images/logo/logo.png') !!}">
    <title>MotoGest</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300&display=swap');
        
        * {
            font-family: 'Sora', sans-serif;

            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial;
            font-size: 17px;
        }

        #backgroundVideo {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1; 
        }

        .content {
            position: fixed;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            color: #f1f1f1;
            width: 100%;
            padding: 20px;
            z-index: 1; 
        }

        .botonesDerecha {
            text-align: right
        }

        a {
            text-decoration: none;
            color: white
        }

        #logoOverlay {
            position: fixed;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2; 
            transition: width 0.3s;

        }

        #logoOverlay:hover{
            width: 380px;
            cursor: pointer;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</head>

<body>
    <img id="logoOverlay" src="{!! asset('images/logo/logoPNG.png') !!}" width="350px">

    <video autoplay muted loop id="backgroundVideo">
        <source src="{!! asset('images/varios/backgroundVideo.mp4') !!}" type="video/mp4">
        El navegador no soporta este video
    </video>

    <div class="content">
        <h1>MotoGest</h1>
        <p>Tu web donde podrás gestionar el mantenimiento de tus motos de la manera más sencilla</p>
        <button id="botonPausar" class="btn btn-success" onclick="funcionPausar()">Pausar</button>

        <div class="botonesDerecha">
            @if (Route::has('login'))
            @auth
            <a href="{{ url('/home') }}" class="btn btn-primary">Entrar</a>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="btn btn-warning">Registrarse</a>
            @endif
            @endauth
            @endif
        </div>
    </div>

    <script>
        var video = document.getElementById("backgroundVideo");
        var btn = document.getElementById("botonPausar");

        function funcionPausar() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pausar";
            } else {
                video.pause();
                btn.innerHTML = "Reproducir";
            }
        }
    </script>
</body>

</html>
