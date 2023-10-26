<!DOCTYPE html>
<html lang="es">

<head>
    <link rel="icon" type="image/x-icon" href="{!! asset('images/logo/logo.png') !!}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Error 404</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300&display=swap');

        * {
            font-family: 'Sora', sans-serif;

            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            font-size: 16px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        header {
            min-height: 50px;
        }

        .head-text {
            text-transform: uppercase;
            width: 200px;
            height: auto;
            padding: 20px;
        }

        .head-text,
        .main-wrapper {
            width: 80%;
            margin: auto;
        }

        .main-wrapper {
            display: flex;
        }

        .scarecrow-img img {
            width: 90%;
            height: auto;
        }

        .error-text {
            width: 70%;
        }

        .error-text h2 {
            width: 80%;
            font-size: 3.75rem;
            letter-spacing: 0.5px;
            font-weight: normal;
        }

        .error-text p {
            width: 50%;
            padding: 5px;
        }

        button {
            cursor: pointer;
            width: auto;
            padding: 15px;
            border: 1px solid #333;
            border-radius: 3px;
            color: white;
            background-color: #333;
            text-transform: uppercase;
            margin-top: 15px;
        }

        footer {
            padding: 15px;
            text-align: center;
            min-height: 50px;
            margin-top: auto;
        }

        .fa-copyright {
            font-weight: lighter;
        }

        @media (max-width: 991.9px) {
            .main-wrapper {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .error-text h2 {
                width: 100%;
                font-size: 3rem;
                line-height: 100%;
                padding-top: 15px;
            }

            .error-text p {
                width: 100%;
                font-size: 0.8rem;
                line-height: 150%;
                padding-top: 15px;
            }
        }

        @media (min-width: 992px) {
            .error-text h2 {
                width: 100%;
                line-height: 100%;
                padding-top: 15px;
            }

            .error-text p {
                width: 100%;
                line-height: 150%;
                padding-top: 15px;
            }
        }


    </style>
</head>

<body>

    <header>
        <div class="head-text">
            <h1> Error 404 Not Found</h1>
        </div>
    </header>

    <main>
        <div class="main-wrapper">
            <picture class="scarecrow-img">
                <img src="{!! asset('images/logo/logo.png') !!}" alt="scarecrow">
            </picture>
            <div class="error-text">
                <h2>¡Vaya!, Parece que te has perdido...</h2>
                <p>La página que buscabas no existe o esta inactiva</p>
                <span class="input-group-btn">
                    <a href="/home">Volver al inicio</a>
                </span>
            </div>
        </div>
    </main>
</body>

</html>
