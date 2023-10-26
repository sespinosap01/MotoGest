<!doctype html>
<html lang="es">

<head>
    <link rel="icon" type="image/x-icon" href="{!! asset('images/logo/logo.png') !!}">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/ac494230e8.js" crossorigin="anonymous"></script>
    <!-- Font Awesome -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Bootstrap -->

    <!-- Libreria Select2 -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="select2.css">
    <link rel="stylesheet" href="select2-bootstrap.css">
    <!-- Libreria Select2 -->



    <title>MotoGest</title>

    <!-- Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300&display=swap');

        * {
            font-family: 'Sora', sans-serif;
        }

        #app {
            flex: 1;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
        background: #c65f20; 
       }

        ::-webkit-scrollbar-thumb:hover {
        background: #964818; 
        }
    </style>

    <!-- Script vite -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- AOS(animaciones de carga) -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- AOS(animaciones de carga) -->

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-dark bg-dark navbar-expand-md">
            <div class="container">
                <div class="navbar-brand">
                    <a href="/" class="text-decoration-none"><img src="{!! asset('images/logo/logoPNG.png') !!}"
                            width="80px"></a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse fs-5" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"
                                    style="color: #c65f20;"></i> Iniciar Sesión</a>
                        </li>
                        @endif

                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i class="fa-solid fa-id-card"
                                    style="color: #c65f20;"></i> Registrarse</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}"> <i class="fa-solid fa-house"
                                    style="color: #c65f20;"></i>
                                Inicio</a>
                        </li>
                        @if(Auth::user()->rol->name == "Admin")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('adminPanel') }}"> <i class="fa-solid fa-lock"
                                    style="color: #c65f20;"></i>
                                Panel de administrador</a>
                        </li>
                        @endif

                        @if(Auth::user()->rol->name == "User")
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('clientes.clientPanel') }}"><i
                                    class="fa-solid fa-table-columns" style="color: #c65f20;"></i>
                                Panel de usuario</a>
                        </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                                    class="fa-solid fa-user" style="color: #c65f20;"></i>
                                {{ Auth::user()->nombre }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit', ['profile' => Auth::user()->idUsuario]) }}">
                                    Editar perfil
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4 mb-0">
            @yield('content')
        </main>
    
    
    </div>

    <script>
        AOS.init();

    </script>

    <script>
        // Scritp para poder usar Select2
        $(document).ready(function () {
            $('.js-example-basic-single').select2({

            });
        });

    </script>

</body>

</html>
