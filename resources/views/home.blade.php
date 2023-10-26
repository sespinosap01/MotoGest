@extends('layouts.app')

@section('content')

<style>
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

.content {
    min-height: 100%;
    margin-bottom: -20%;
}

</style>

<div class="content" data-aos="fade-up">

<div class="container px-4 text-center">
    <h1>¡Hola {{ Auth::user()->nombre }}!</h1>
    <p>Bienvenido a <b>MotoGest</b>, la aplicación web para llevar un control sobre los mantenimientos actuales de tu moto</p>
    <a class="btn text-white btn-xl" style="background-color: #c65f20;" href="#about">Conócenos</a>
   <br><br>
    <!-- Carousel for images -->
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner active">
            <div class="carousel-item active">
                <img src="{!! asset('images/varios/slider1.jpg') !!}" class="d-block w-100 rounded" alt="imgSlider1">
            </div>
            <div class="carousel-item">
               <img src="{!! asset('images/varios/slider2.jpg') !!}" class="d-block w-100 rounded" alt="imgSlider2">
            </div>
            <div class="carousel-item">
               <img src="{!! asset('images/varios/slider3.jpg') !!}" class="d-block w-100 rounded" alt="imgSlider3">
            </div>
            <div class="carousel-item">
               <img src="{!! asset('images/varios/slider4.jpg') !!}" class="d-block w-100 rounded" alt="imgSlider4">
            </div>
            <div class="carousel-item">
               <img src="{!! asset('images/varios/slider5.jpg') !!}" class="d-block w-100 rounded" alt="imgSlider5">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>
    <br>
</div>

<!-- About section -->
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Sobre nosotros</h2>
                <p>En <b>MotoGest</b>, estamos comprometidos a proporcionarte una forma sencilla y efectiva 
                  de llevar un control sobre los mantenimientos de tu moto. Nuestra aplicación te permite
                  gestionarlos de forma sencilla</p>
          
            </div>
        </div>
    </div>

    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>¡Descarga ya la app de <b>MotoGest</b>!</h2>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <img src="{{ asset('images/varios/tablet.png') }}" width="90%">
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('images/varios/movil.png') }}" width="150%">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="col-md-6">
                            <a href="https://www.apple.com/es/app-store/" class="btn btn-primary" target="_blank">Descargar en IOS</a>
                        </div>
                        <div class="col-md-6">
                            <a href="https://play.google.com/store/" class="btn btn-success" target="_blank">Descargar en Android</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Preguntas frecuentes</h2>
                <ul>
                    <li>Pregunta de prueba</li>
                    <li>Pregunta de prueba</li>
                    <li>Pregunta de prueba</li>
                    <li>Pregunta de prueba</li>
                </ul>
          
            </div>
        </div>
    </div>

<!-- Contact section -->
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Contacto</h2>
                <p>Si tienes alguna pregunta o comentario, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte en todo lo que necesites.</p>
            </div>
        </div>
    </div>
<!-- Footer section -->
<footer class="footer bg-dark text-white py-3 text-center">
   &copy; MotoGest 2023
</footer>
</div>

@endsection

