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

hr{
  height: 2px;
  width: 70%;
  position: relative;
  margin: 30px auto;
  background: black;
}

</style>

<div class="content" data-aos="fade-up">

<div class="container px-4 text-center mb-3">
    @if (Auth::check())
    <h1>¡Hola {{ Auth::user()->nombre }}!</h1>
    @else
    <h1>¡Hola invitado!</h1>
    @endif
    <p>Bienvenido a <b>MotoGest</b>, la aplicación web para llevar un control sobre los mantenimientos actuales de tu moto</p>
    <a class="btn text-white btn-xl" style="background-color: #c65f20;" href="#about">Conócenos</a>
   <br><br>
    <!-- Carousel for images -->
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel" >
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

<hr  id="about">

<!-- About section -->
    <div class="container px-4 mb-3" data-aos="fade-left">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Sobre nosotros</h2>
                <p> En <b>MotoGest</b>, como programadores apasionados, nos hemos comprometido a brindarte una solución eficiente y 
                    sencilla para el seguimiento de los mantenimientos de tu moto. Nuestra aplicación, diseñada con la experiencia 
                    de quienes comprenden la importancia de la gestión eficaz, te permite llevar un registro detallado y sin 
                    complicaciones de todas las tareas de mantenimiento necesarias para mantener tu moto en óptimas condiciones. 
                    Con <b>MotoGest</b>, podrás estar seguro de que tu moto recibirá la atención que merece, y todo esto al alcance de tu mano 
                    de manera sencilla y conveniente."
                </p>
          
            </div>
        </div>
    </div>

    <hr>

    <div class="container px-4 mb-3" data-aos="fade-right">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>¡Descarga próximamente la app de <b>MotoGest</b>!</h2>
                <div class="row text-center mb-4"> <!-- Añadido text-center para centrar los botones horizontalmente -->
                    <img src="{{ asset('images/varios/appPubli.png') }}" width="100%">
                </div>
                <div class="row text-center"> <!-- Añadido text-center para centrar los botones horizontalmente -->
                    <div class="col-md-6 col-6"> <!-- Cambiado col-md-6 a col-md-6 col-6 para que estén uno al lado del otro -->
                        <a href="https://www.apple.com/es/app-store/" class="btn btn-dark" target="_blank"><i class="fa-brands fa-app-store fa-lg" style="color: #ffffff;"></i> Ver en IOS</a>
                    </div>
                    <div class="col-md-6 col-6"> <!-- Cambiado col-md-6 a col-md-6 col-6 para que estén uno al lado del otro -->
                        <a href="https://play.google.com/store/" class="btn btn-dark" target="_blank"><i class="fa-brands fa-google-play fa-lg" style="color: #ffffff;"></i> Ver en Android</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <hr>

    <div class="container px-4 mb-3" data-aos="fade-left">
        <div class="row gx-4 justify-content-center">
            <div class="col-lg-8">
                <h2>Preguntas frecuentes</h2>
                <div class="accordion" id="faqAccordion">
                    <div class="card">
                        <div class="card-header" id="faqHeading1">
                            <h5 class="mb-0">
                                <button class="btn " type="button" data-toggle="collapse" data-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1">
                                    ¿Qué información necesito proporcionar al registrar una moto?
                                </button>
                            </h5>
                        </div>
                        <div id="faqCollapse1" class="collapse" aria-labelledby="faqHeading1" data-parent="#faqAccordion">
                            <div class="card-body">
                                Es simple, solamente tendrás que añadir datos como la marca, el modelo, cilindriada, la potencia en cv...
                            </div>
                        </div>
                    </div>
                        
                    <div class="card">
                        <div class="card-header" id="faqHeading2">
                            <h5 class="mb-0">
                                <button class="btn " type="button" data-toggle="collapse" data-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                                    ¿Puedo agregar varias motos a mi cuenta?
                                </button>
                            </h5>
                        </div>
                        <div id="faqCollapse2" class="collapse" aria-labelledby="faqHeading2" data-parent="#faqAccordion">
                            <div class="card-body">
                                Si, podrás agregar tantas motos como tengas.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading3">
                            <h5 class="mb-0">
                                <button class="btn " type="button" data-toggle="collapse" data-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                                    ¿Qué tipo de información de mantenimiento debo ingresar?
                                </button>
                            </h5>
                        </div>
                        <div id="faqCollapse3" class="collapse" aria-labelledby="faqHeading3" data-parent="#faqAccordion">
                            <div class="card-body">
                                Solo tendrás que incluir periódicamente el kilometraje que has recorrido y la aplicación calculará todo por tí.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading4">
                            <h5 class="mb-0">
                                <button class="btn " type="button" data-toggle="collapse" data-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                                    ¿Puedo recibir recordatorios para hacer mis mantenimientos?
                                </button>
                            </h5>
                        </div>
                        <div id="faqCollapse4" class="collapse" aria-labelledby="faqHeading4" data-parent="#faqAccordion">
                            <div class="card-body">
                                Sí, la aplicación te avisará cuando te falte poco para un nuevo mantenimiento.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading5">
                            <h5 class="mb-0">
                                <button class="btn" type="button" data-toggle="collapse" data-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                                    ¿Está segura la información de mis motos en la plataforma?
                                </button>
                            </h5>
                        </div>
                        <div id="faqCollapse5" class="collapse" aria-labelledby="faqHeading5" data-parent="#faqAccordion">
                            <div class="card-body">
                                ¡Por supuesto! Utilizamos las últimas tecnologías web para almacenar tu información.
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" id="faqHeading6">
                            <h5 class="mb-0">
                                <button class="btn " type="button" data-toggle="collapse" data-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6">
                                    ¿La aplicación tiene una versión móvil o una aplicación para smartphone?
                                </button>
                            </h5>
                        </div>
                        <div id="faqCollapse6" class="collapse" aria-labelledby="faqHeading6" data-parent="#faqAccordion">
                            <div class="card-body">
                                Todavía no, aunque próximamente estará disponible tanto para Android como IOS. Aun así, el diseño responsive de la web permite el uso desde cualquier dispositivo
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <hr>

    <div class="container px-4 mb-3" data-aos="fade-right">
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

