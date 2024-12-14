@extends('layout.app_usuario')

@section('title', 'Mis Favoritos')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f9f9f9;
        }

        .favorito-item {
            display: flex;
            align-items: center;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        .favorito-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .favorito-img {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
            margin-right: 15px;
        }

        .favorito-info {
            flex: 1;
        }

        .favorito-info h5 {
            margin: 0;
            font-size: 1.2rem;
            color: #333;
        }

        .favorito-info p {
            margin: 5px 0;
            color: #666;
        }

        .favorito-actions {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .favorito-actions button {
            margin-top: 5px;
            border: none;
            background-color: #E50914;
            color: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        .favorito-actions button:hover {
            background-color: #b20710;
        }

        .favorito-actions .btn-secondary {
            background-color: #007bff;
        }

        .favorito-actions .btn-secondary:hover {
            background-color: #0056b3;
        }
    </style>
@endpush

@section('content')
<div class="container py-4">
    <h1 class="text-center mb-4">Mis Favoritos</h1>
    @if(isset($favoritos) && count($favoritos) > 0)
        @foreach($favoritos as $favorito)
            <div class="favorito-item">
                <img src="{{ $favorito->imagen_url }}" alt="{{ $favorito->marca }} {{ $favorito->modelo }}"
                    class="favorito-img">
                <div class="favorito-info">
                    <h5>{{ $favorito->marca }} {{ $favorito->modelo }}</h5>
                    <p>Año: {{ $favorito->anio }}</p>
                    <p class="fw-bold">Precio: ${{ number_format($favorito->precio, 2) }}</p>
                </div>
                <div class="favorito-actions">
                    <button class="btn btn-danger btn-eliminar" data-placa="{{ $favorito->placa }}">
                        <i class="fas fa-trash"></i> Eliminar
                    </button>
                    <a href="{{ route('usuario_vehiculo', $favorito->placa) }}" class="btn btn-secondary">
                        <i class="fas fa-eye"></i> Ver
                    </a>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center">No tienes vehículos en tu lista de favoritos.</p>
    @endif
</div>
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.btn-eliminar').on('click', function () {
                // Obtén la placa del atributo data-placa
                let placa = $(this).data('placa');
                let button = $(this); // El botón actual

                if (confirm('¿Estás seguro de que deseas eliminar este vehículo de tus favoritos?')) {
                    // Realiza la solicitud AJAX
                    $.ajax({
                        url: "{{ route('usuario_eliminarfavorito', ['placa' => ':placa']) }}".replace(':placa', placa),
                        type: 'DELETE',
                        data: {
                            _token: "{{ csrf_token() }}" // Token CSRF requerido por Laravel
                        },
                        success: function (response) {
                            if (response.success) {
                                alert(response.message); // Mostrar mensaje de éxito
                                button.closest('.favorito-item').remove(); // Eliminar la tarjeta del DOM
                            } else {
                                alert('Error: ' + response.message);
                            }
                        },
                        error: function (xhr) {
                            // Manejo de errores
                            alert('Error al eliminar el favorito. Inténtalo de nuevo.');
                        }
                    });
                }
            });
        });

    </script>
@endpush
@endsection