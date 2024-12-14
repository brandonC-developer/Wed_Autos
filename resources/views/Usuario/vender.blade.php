@extends('layout.app_usuario')

@section('title', 'Registrar Vehículo')

@section('content')
<style>
    .form-control {
        background-color: #3a3a3a;
        color: #ffffff;
        border-color: #660033;
    }

    .form-select {
        background-color: #3a3a3a;
        color: #ffffff;
        border-color: #660033;
    }

    #mensaje {
        margin-top: 20px;
        font-size: 1.2em;
    }
</style>
<div class="container py-4">
    <div class="card shadow-lg" style="background-color: #2b2b2b; color: #ffffff;">
        <div class="card-header" style="background-color: #4a1e2e; color: #ffffff;">
            <h3 class="mb-0 text-center">
                <i class="fas fa-car"></i> Registrar Vehículo
            </h3>
        </div>
        <div class="card-body">
            <!-- Mostrar mensaje de éxito -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert"
                    style="background-color: #4a1e2e; color: #ffffff; border-color: #660033;">
                    {{ session('success') }}
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif

            <!-- Formulario de Registro de Vehículo -->
            <form id="vehiculoForm" enctype="multipart/form-data">
                @csrf
                <input type="text" name="placa" placeholder="Placa" required>
                <input type="text" name="num_motor" placeholder="Número de motor" required>

                <!-- Campo para el año con un rango de años desde 1980 hasta el año actual -->
                <select name="anio" required>
                    <option value="" disabled selected>Seleccione el año</option>
                    @php
                        $currentYear = date('Y'); // Año actual
                    @endphp
                    @for ($year = 1980; $year <= $currentYear; $year++)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>

                <input type="text" name="marca" placeholder="Marca" required>
                <input type="text" name="modelo" placeholder="Modelo" required>
                <input type="number" name="precio" placeholder="Precio" required>
                <input type="number" name="kilometraje" placeholder="Kilometraje" required>
                <input type="number" name="cilindraje" placeholder="Cilindraje" required>

                <!-- Campo para la transmisión con opciones "Manual" y "Automatico" -->
                <select name="transmision" required>
                    <option value="" disabled selected>Seleccione la transmisión</option>
                    <option value="Manual">Manual</option>
                    <option value="Automatico">Automático</option>
                </select>

                <!-- Campo para el combustible con opciones "Gasolina", "Diesel", "Electrico" y "Hibrido" -->
                <select name="combustible" required>
                    <option value="" disabled selected>Seleccione el combustible</option>
                    <option value="Gasolina">Gasolina</option>
                    <option value="Diesel">Diesel</option>
                    <option value="Electrico">Eléctrico</option>
                    <option value="Hibrido">Híbrido</option>
                </select>

                <input type="text" name="color_exterior" placeholder="Color exterior" required>
                <input type="text" name="color_interior" placeholder="Color interior" required>

                <!-- Cambio aquí para permitir la carga de imágenes -->
                <input type="file" name="imagen_url" required>

                <button type="submit">Registrar Vehículo</button>
            </form>

            <div id="mensaje"></div>
        </div>
    </div>
</div>
<script>
    document.getElementById("vehiculoForm").addEventListener("submit", function (e) {
        e.preventDefault(); // Evitar envío normal del formulario

        let formData = new FormData(this); // Capturar datos del formulario

        fetch("{{ route('vehiculo.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value,
            }
        })
            .then((response) => response.json())
            .then((data) => {
                let mensajeDiv = document.getElementById("mensaje");
                mensajeDiv.innerHTML = `<p style="color: green;">${data.message}</p>`;
            })
            .catch((error) => {
                let mensajeDiv = document.getElementById("mensaje");
                mensajeDiv.innerHTML = `<p style="color: red;">Error al registrar el vehículo.</p>`;
            });
    });
</script>
@endsection