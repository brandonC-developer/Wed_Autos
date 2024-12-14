<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Plataforma de Compra/Venta de Vehículos')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/card-vehiculos.css') }}">
    @stack('css')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <style>
        body {
            font-family: "Market Sans", Arial, sans-serif;
        }
        
    </style>
</head>

<body>
    <!-- Header/Nav -->
    <header>
        <div class="row-fluid bg-dark">
            <div class="px-1 mx-1 w-100">
                <div class="d-flex flex-wrap align-items-center px-3">
                    <a href={{route('usuario')}}
                        class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
                        <img class="rounded-circle " src="{{ asset('/storage/img/logo.webp') }}" width="120"
                            height="100" alt="">
                    </a>

                    <div class="d-flex  align-items-end">
                        <!-- Asegurarse de que este ul esté centrado -->
                        <ul class="nav col-12 col-lg-auto my-2 text-small align-self-center">
                            <li>
                                <img src="{{ asset('/storage/img/index/certificado.png') }}" width="150" height="80"
                                    alt="">
                            </li>
                            <li class="px-5">
                                <a href="{{ route('usuario_favoritos') }}" class="nav-link text-white">
                                    <img class="rounded-circle" src="{{ asset('/storage/img/index/corazon.png') }}"
                                        width="30" height="30" alt="">
                                    Guardados
                                </a>
                            </li>
                            <li>
                                <!-- <a href="{{ url('/login') }}" class="nav-link text-white"> -->
                                <img src="{{ asset('/storage/img/index/phone.png') }}" width="30" height="30" alt="">
                                Soporte Tecnico
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="d-flex flex-wrap align-items-center justify-content-center">

                    <!-- Asegurarse de que este ul esté centrado -->
                    <ul class="nav col-12 col-lg-auto my-2 justify-content-center text-small">
                        <li>
                            <a href="{{ route('usuario') }}" class="nav-link text-white">
                                Inicio
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('usuario_catalogo') }}" class="nav-link text-white">
                                Catalogo
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('vehiculo.vender') }}" class="nav-link text-white">
                                Vender vehiculo
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </header>


    <main class="m-0" style="width: 100%;">
        @yield('content')
    </main>

    <footer class="text-white text-center py-3 mt-4">
        <div class="container text-white">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top text-light">
                <div class="col mb-3">
                    <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
                        <svg class="bi me-2" width="40" height="32">
                            <use xlink:href="#bootstrap"></use>
                        </svg>
                    </a>
                    &copy; {{ date('Y') }}
                </div>

                <div class="col mb-3">

                </div>

                <div class="col mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column text-white">
                        <li class="nav-item mb-2 text-white"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                    </ul>
                </div>

                <div class="col mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                    </ul>
                </div>

                <div class="col mb-3">
                    <h5>Section</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                    </ul>
                </div>
            </footer>
        </div>
    </footer>

    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Custom Scripts -->
    @stack('scripts')
</body>

</html>