@extends('layout.app_usuario')

@section('title', 'Inicio - Vehículos')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/card-vehiculos.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <style>
        /* Asegura que las imágenes mantengan la proporción */
        .carousel-inner {
            height: 70vh;
        }

        .carousel-item img {
            height: 100%;
            object-fit: cover;
        }

        /* Flechas por defecto */
        .slick-prev,
        .slick-next {
            z-index: 10;
            /* Asegura que estén sobre las tarjetas */
            background-color: rgba(0, 0, 0, 0.5);
            /* Fondo semitransparente */
            color: #fff;
            /* Color del icono */
            border-radius: 50%;
            /* Forma circular */
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Posiciona las flechas */
        .slick-prev {
            left: 10px;
        }

        .slick-next {
            right: 10px;
        }

        /* Cambia el diseño al pasar el cursor */
        .slick-prev:hover,
        .slick-next:hover {
            background-color: rgba(0, 0, 0, 0.8);
            color: #ffcc00;
            /* Color de ejemplo para hover */
        }
    </style>

@endpush


@section('content')

<div class="mx-0">
    <!-- Row principal con dos columnas -->
    <div class="row text-center align-items-center m-0" style="height: 70vh;">

        <!-- Columna izquierda: Formulación con marca y modelo -->
        <div class="col-6 col-xxl-4 themed-grid-col h-100 d-flex flex-column justify-content-center align-items-center"
            style="background-color: #ce181e ;">
            <h3 class="mb-4 fw-bold text-center text-light">Encuentra tu Auto Ideal</h3>
            <form class="text-start w-75" action="{{ route('vehiculo.catalogo') }}" method="GET">
                <div class="mb-3">
                    <label for="marca" class="form-label text-light">Marca</label>
                    <select class="form-select" id="marca" name="marca">
                        <option selected>Selecciona una marca</option>
                        <!-- Ejemplo: opciones dinámicas desde la base de datos -->
                        @foreach($vehiculos_destacados as $vehiculo)
                            <option value="{{ $vehiculo->marca }}">{{ $vehiculo->marca }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="modelo" class="form-label text-light">Modelo</label>
                    <input type="text" class="form-control" id="modelo" name="modelo">
                </div>
                <button type="submit" class="btn w-100 fw-semibold"
                    style="background-color: #58595b; color: white;">Buscar</button>
            </form>
        </div>


        <!-- Columna derecha: Carrusel -->
        <div class="col-xxl-8 themed-grid-col p-0">
            <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Indicadores del carrusel -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                </div>

                <!-- Elementos del carrusel -->
                <div class="carousel-inner">
                    <div class="carousel-item active h-100">
                        <img class="d-block w-100 h-100" src="{{ asset('/storage/img/Carrusel/carrusel.webp') }}"
                            alt="Carrusel 1">

                    </div>
                    <div class="carousel-item h-100">
                        <img class="d-block w-100 h-100" src="{{ asset('/storage/img/Vehiculos/Mazda/Mazda3.jpg') }}"
                            alt="Carrusel 2">
                        <div class="carousel-caption">
                            <h1>Autos confiables.</h1>
                            <p>Vehículos revisados y garantizados por expertos.</p>
                        </div>
                    </div>
                    <div class="carousel-item h-100">
                        <img class="d-block w-100 h-100" src="{{ asset('/storage/img/Carrusel/carrusel.webp') }}"
                            alt="Carrusel 3">
                        <div class="carousel-caption text-end">
                            <h1>Promociones especiales.</h1>
                            <p>No dejes pasar las ofertas exclusivas de esta temporada.</p>
                            <p><a class="btn btn-lg btn-secondary" href="#">Aprovecha Ahora</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Carrusel de Imágenes - Slider de Vehículos -->
<!-- Sección Principal: Bienvenida -->
<div class="jumbotron bg-transparent text-center">
    <h1>¡Bienvenido a nuestra Plataforma de Vehículos!</h1>
    <p>Compra y vende vehículos de forma fácil y rápida. Encuentra tu próximo auto ahora mismo.</p>
    <a href="{{ route('usuario_catalogo') }}" class="btn btn-primary btn-lg">Buscar Vehículos</a>
    <a href="{{ route('vehiculo.vender') }}"  class="btn btn-secondary btn-lg">Registrar Vehículo</a>
</div>

<section style="height: 300px;">
    <div class="row m-2 text-center h-100">
        <!-- Primera columna -->
        <div class="col-6 col-md-4 themed-grid-col px-0 position-relative h-100">
            <img class="w-100 h-100" src="{{ asset('/storage/img/Index/buy_online.webp') }}" alt="">
            <div
                class="overlay position-absolute top-0 start-0 w-100 h-100 align-content-center align-items-center justify-content-center">
                <h5 class="text-white">Compra Online</h5>
                <p class="text-white">En la comodidad de tu hogar</p>
            </div>
        </div>

        <!-- Segunda columna -->
        <div class="col-6 col-md-4 themed-grid-col px-2 position-relative h-100">
            <img class="w-100 h-100" src="{{ asset('/storage/img/Index/used_car.webp') }}" alt="">
            <div
                class="overlay position-absolute top-0 start-0 w-100 h-100 align-content-center align-items-center justify-content-center">
                <h6 class="text-white">Todas las marcas</h6>
                <h5 class="text-white">Carros Usados</h5>
                <p class="text-white">Encuentra tu auto ideal</p>
            </div>
        </div>

        <!-- Tercera columna -->
        <div class="col-6 col-md-4 themed-grid-col px-0 position-relative h-100">
            <img class="w-100 h-100" src="{{ asset('/storage/img/Index/support.webp') }}" alt="">
            <div
                class="overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center">
                <h5 class="text-white">Soporte</h5>
            </div>
        </div>
    </div>
</section>


<style>
    /* Oscurece la imagen con una capa superpuesta */
    .overlay {
        background-color: rgba(0, 0, 0, 0.5);
        /* Oscurece con un semitransparente */
        z-index: 1;
        /* Asegura que la capa esté sobre la imagen */
    }

    /* Asegura que el texto esté visible */
    .overlay h5 {
        margin: 0;
        font-size: 1.5rem;
        /* Ajusta el tamaño del texto */
        z-index: 2;
        /* Asegura que el texto esté sobre la capa de fondo */
    }
</style>

<!-- Sección Vehículos Destacados -->
<h2 class="text-center text-light fw-semibold my-5">Vehículos Destacados</h2>
<div class="slider autoplay">
    @foreach($vehiculos_destacados as $vehiculo)
        <div class="px-2">
            <div class="card shadow-sm rounded-0 border-0">
                <img src="{{ $vehiculo->imagen_url }}" class="card-img-top"
                    alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}">
                <div class="card-body text-center">
                    <h4 class="card-title text-light">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h4>
                    <p class="card-text">{{ $vehiculo->anio }} </p>
                    <h6 class="fw-bold" style="color: #E50914;"> ${{ number_format($vehiculo->precio, 2) }}</h6>
                </div>
            </div>
        </div>
    @endforeach
</div>

<script>
    $('.slider.autoplay').slick({
        dots: true,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fas fa-chevron-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fas fa-chevron-right"></i></button>',
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1,
                }
            },
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });



</script>
@push('scripts')

@endpush
@endsection