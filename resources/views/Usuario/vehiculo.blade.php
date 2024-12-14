@extends('layout.app_usuario')

@section('title', 'Catálogo de Vehículos')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/buscar.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        p {
            font-style: oblique;
            padding: 10px;
        }

        svg {
            width: 30px;
        }
    </style>
@endpush

@section('content')

<div class="row mb-3 text-center">
    <div class="col-8 themed-grid-col border-end">
        <div id="vehiculoContainer" class="row justify-content-center">
            <div class="col-12 col-md-6 w-100">
                <div class="container w-75">
                    <img src="{{ $vehiculo->imagen_url }}" class="card-img"
                        alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}">
                </div>
            </div>
        </div>
        <div class="d-inline-flex text-light border-top pt-4">
            <div class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar" viewBox="0 0 16 16">
                    <path
                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                </svg>
                <p>{{ $vehiculo->anio}}</p>
            </div>
            <div class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-speedometer"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z" />
                    <path fill-rule="evenodd"
                        d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0" />
                </svg>
                <p>{{ $vehiculo->kilometraje}}</p>
            </div>
            <div class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-fuel-pump" viewBox="0 0 16 16">
                    <path d="M3 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5z" />
                    <path
                        d="M1 2a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v8a2 2 0 0 1 2 2v.5a.5.5 0 0 0 1 0V8h-.5a.5.5 0 0 1-.5-.5V4.375a.5.5 0 0 1 .5-.5h1.495c-.011-.476-.053-.894-.201-1.222a.97.97 0 0 0-.394-.458c-.184-.11-.464-.195-.9-.195a.5.5 0 0 1 0-1q.846-.002 1.412.336c.383.228.634.551.794.907.295.655.294 1.465.294 2.081v3.175a.5.5 0 0 1-.5.501H15v4.5a1.5 1.5 0 0 1-3 0V12a1 1 0 0 0-1-1v4h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1zm9 0a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v13h8z" />
                </svg>
                <p>{{ $vehiculo->combustible}}</p>
            </div>
            <div class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-geo-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                </svg>
                <p>{{ $vehiculo->transmision}}</p>
            </div>
            <div class="me-3">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-nvme" viewBox="0 0 16 16">
                    <path
                        d="M1.5 4.5A.5.5 0 0 1 2 4h13.5a.5.5 0 0 1 .5.5V7a.5.5 0 0 1-.5.5.5.5 0 0 0 0 1 .5.5 0 0 1 .5.5v2.5a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5h-1A.5.5 0 0 1 0 11V7.5A.5.5 0 0 1 .5 7h1a.25.25 0 0 0 0-.5h-1A.5.5 0 0 1 0 6V5a.5.5 0 0 1 .5-.5zm1 .5a.5.5 0 0 1-.5.5h-.5a1.25 1.25 0 1 1 0 2.5H1v2.5h1a.5.5 0 0 1 .5.5H15V9.415a1.5 1.5 0 0 1 0-2.83V5z" />
                    <path
                        d="M4 6.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5zM5 7v2h1V7zm3-.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-4a.5.5 0 0 1-.5-.5zM9 7v2h3V7z" />
                </svg>
                <p>{{ $vehiculo->cilindraje}}</p>
            </div>
        </div>
        <h5>

        </h5>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Marca
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->marca}}</p>
            </div>
        </div>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Modelo
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->modelo}}</p>
            </div>
        </div>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Año
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->anio}}</p>
            </div>
        </div>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Numero Placa
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->placa}}</p>
            </div>
        </div>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Numero Motor
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->num_motor}}</p>
            </div>
        </div>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Color Exterior
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->color_exterior}}</p>
            </div>
        </div>
        <div class="container d-flex flex-wrap align-items-center w-75 border-bottom">
            <p class="d-flex align-items-center my-lg-0 me-lg-auto text-white text-decoration-none px-0">Color Interior
            </p>
            <div class="d-flex align-items-end">
                <p class="m-0 px-0 text-white"> {{ $vehiculo->color_interior}}</p>
            </div>
        </div>
    </div>
    <div class="col-4 themed-grid-col d-flex">
        <d class="shadow-lg p-4" style="background-color: #1a1a1a;">
            <div class="mb-4">
                <h3 class="text-white text-start mb-0">
                    {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                </h3>
            </div>
            <div class="mb-3">
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3 class="m-0 text-danger">$ {{ $vehiculo->precio }}</h3>
            </div>
            <div class="text-start mb-3">
                <span class="badge bg-secondary">Estado: Usado</span>
            </div>
            <div class="mb-3 text-white text-start">
                <p class="mb-1">Fecha de Registro: {{ $vehiculo->fecha_registro ?? 'N/A' }}</p>
            </div>
            <div class="d-flex flex-column gap-3 mb-5">
                <a href={{route('usuario_comprar',  $vehiculo->placa)}} class="btn btn-danger w-100">Cómpralo</a>
                <button id="agregarFavorito" class="btn btn-outline-light" data-placa={{$vehiculo->placa}}>Agregar a
                    Favoritos</button>
                <button type="button" class="btn btn-secondary w-100">Contactar al vendedor</button>
            </div>
            <hr class="text-white mb-5">
            <div class="my-5 text-white text-start">
                <h5 class="mb-2">Opciones de envío:</h5>
                <p class="mb-1">Ubicación actual: {{ $vehiculo->direccion ?? 'Plant City, Florida, Estados Unidos' }}
                </p>
                <p class="mb-1">Entrega: Variable</p>
            </div>
            <hr class="text-white mb-5">
            <div class="mb-4 text-white text-start">
                <h5 class="mb-2">Pagos:</h5>
                <p class="mb-1 text-light">Depósito inicial: USD $500.00 (48 horas después de finalizar el anuncio)</p>
                <p class="mb-1 text-light">Pago completo en un plazo de 3 días tras finalizar el anuncio</p>
                <p class="mb-1 text-light">Depósito inmediato requerido para la opción "¡Cómpralo ahora!"</p>
            </div>
            <hr class="text-white mb-5">
            <div class="mb-4 text-white text-start">
                <h5 class="mb-2">Compra con confianza:</h5>
                <p class="mb-1 text-light">Protección de compra de vehículos: Cubre hasta $100,000 en transacciones
                    realizadas en
                    la plataforma</p>
                <a href="#" class="text-danger">Más información sobre restricciones</a>
            </div>
    </div>



</div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#agregarFavorito').on('click', function () {
                // Obtén la placa del atributo del botón
                let placa = $(this).data('placa');

                // Realiza la solicitud AJAX
                $.ajax({
                    url: "{{ route('usuario_agregarfavorito', ['placa' => ':placa']) }}".replace(':placa', placa),
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}" // Token CSRF requerido por Laravel
                    },
                    success: function (response) {
                        if (response.success) {
                            alert(response.message); // Mensaje de éxito
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function (xhr) {
                        // Manejo de errores
                        alert('Error al agregar a favoritos. Inténtalo de nuevo.');
                    }
                });
            });
        });
    </script>
@endpush