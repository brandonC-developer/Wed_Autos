@extends('layout.app_usuario')

@section('title', 'Catálogo de Vehículos')

@push('css')
    <link rel="stylesheet" href="{{ asset('css/buscar.css') }}">
@endpush

@section('content')

<div class="row mb-3">
    <!-- Formulario de búsqueda -->
    <div class="col-10 themed-grid-col border-end px-4" style="width: 15%;min-width: 200px;">
        <form id="buscarVehiculosForm">
            <h2 class="text-center mb-4">Catálogo de Vehículos</h2>
            <div class="d-flex flex-column align-items-stretch">
                <!-- Campo Marca -->
                <div class="mb-3">
                    <label for="marca" class="form-label text-light">Marca</label>
                    <select class="form-select" id="marca" name="marca">
                        <option value="" selected>Selecciona una marca</option>
                        @foreach($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->marca }}">{{ $vehiculo->marca }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Campo Modelo -->
                <div class="mb-3">
                    <label for="modelo" class="form-label text-light">Modelo</label>
                    <input type="text" id="modelo" name="modelo" class="form-control" placeholder="Modelo">
                </div>
                <!-- Campo Año -->
                <div class="mb-3">
                    <label for="anio" class="form-label text-light">Año</label>
                    <input type="number" id="anio" name="anio" class="form-control" placeholder="Año">
                </div>
                <!-- Botón Buscar -->
                <div class="mt-4">
                    <button type="button" id="buscarVehiculos" class="btn btn-primary w-100">Buscar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Catálogo de Vehículos -->
    <div class="col-10 col-lg-10 themed-grid-col mx-1">
        <div id="vehiculosContainer" class="row justify-content-center">
            @foreach($vehiculos as $vehiculo)
                <div class="col-12 col-md-3 mb-3">
                    <div class="card shadow-sm">
                        <img src="{{ $vehiculo->imagen_url }}" class="card-img-top"
                            alt="{{ $vehiculo->marca }} {{ $vehiculo->modelo }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</h5>
                            <p class="card-text">{{ $vehiculo->anio }} | ${{ number_format($vehiculo->precio, 2) }}</p>
                            <a href="{{ route('usuario_vehiculo', $vehiculo->placa) }}" class="btn btn-primary">Ver Más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>




@endsection

@push('scripts')
    <script>
        document.getElementById('buscarVehiculos').addEventListener('click', function () {
            const form = document.getElementById('buscarVehiculosForm');
            const formData = new FormData(form);
            const queryString = new URLSearchParams(formData).toString();
            console.log(queryString);
            fetch(`{{ url('vehiculo/buscar') }}?${queryString}`, {
                method: "GET",
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('vehiculosContainer');
                    container.innerHTML = '';

                    if (data.length === 0) {
                        container.innerHTML = '<p class="text-center">No se encontraron vehículos con los criterios seleccionados.</p>';
                    } else {
                        data.forEach(vehiculo => {
                            const vehiculoCard = `
                                    <div class="col-md-4 mb-4">
                                        <div class="card shadow-sm">
                                            <img src="${vehiculo.imagen_url}" class="card-img-top" alt="${vehiculo.marca} ${vehiculo.modelo}">
                                            <div class="card-body">
                                                <h5 class="card-title">${vehiculo.marca} ${vehiculo.modelo}</h5>
                                                <p class="card-text">${vehiculo.anio} | $${new Intl.NumberFormat().format(vehiculo.precio)}</p>
                                                <a href="/vehiculo/${vehiculo.id}" class="btn btn-primary">Ver Más</a>
                                            </div>
                                        </div>
                                    </div>`;
                            container.innerHTML += vehiculoCard;
                        });
                    }
                })
                .catch(error => console.error('Error al buscar vehículos:', error));
        });

    </script>
@endpush