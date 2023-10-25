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
    margin-bottom: -20%; /* La altura del footer */
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
<section id="about">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Sobre nosotros</h2>
                <p>En MotoGest, estamos comprometidos a proporcionarte una forma sencilla y efectiva 
                  de llevar un control sobre los mantenimientos de tu moto. Nuestra aplicación te permite
                  gestionarlos de forma sencilla</p>
          
            </div>
        </div>
    </div>
</section>

<!-- Contact section -->
<section id="contact">
    <div class="container px-4">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Contacto</h2>
                <p>Si tienes alguna pregunta o comentario, no dudes en ponerte en contacto con nosotros. Estamos aquí para ayudarte en todo lo que necesites.</p>
            </div>
        </div>
    </div>
</section>
<!-- Footer section -->
<footer class="footer bg-dark text-white py-3 text-center">
   &copy; MotoGest 2023
</footer>
</div>

@endsection

