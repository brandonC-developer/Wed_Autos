<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\User;
use App\Models\Favorito;
use Illuminate\Support\Facades\Cookie;

class UserController extends Controller
{
    //
    public function index()
    {
        $vehiculosDestacados = Vehiculo::orderBy('fecha_registro', 'desc')->take(6)->get();

        foreach ($vehiculosDestacados as $vehiculo) {
            $vehiculo->imagen_url = asset('storage/' . $vehiculo->imagen_url);  // Genera la URL correcta
        }

        return view('homeUsuario', [
            'vehiculos_destacados' => $vehiculosDestacados,
        ]);
    }
    public function indexCatalogo(Request $request)
    {
        $query = Vehiculo::query();

        // Aplicar filtros
        if ($request->filled('marca')) {
            $query->where('marca', $request->marca);
        }
        if ($request->filled('modelo')) {
            $query->where('modelo', 'LIKE', '%' . $request->modelo . '%');
        }
        if ($request->filled('anio_desde') && $request->filled('anio_hasta')) {
            $query->whereBetween('anio', [$request->anio_desde, $request->anio_hasta]);
        }

        $vehiculos = $query->get();

        // Ajustar URLs de imágenes
        foreach ($vehiculos as $vehiculo) {
            $vehiculo->imagen_url = asset('storage/' . $vehiculo->imagen_url);
        }

        // Devolver respuesta JSON si es AJAX
        if ($request->ajax()) {
            return response()->json($vehiculos);
        }

        // Devolver vista si no es AJAX
        return view('Usuario.catalogo', ['vehiculos' => $vehiculos]);
    }
    public function descripcion($id)
    {
        // Buscar el vehículo junto con su propietario
        $vehiculo = Vehiculo::obtenerPropietariosPorPlaca($id);

        // Verificar si el vehículo existe
        if (!$vehiculo) {
            // Retornar error 404 si el vehículo no fue encontrado
            abort(404, 'El vehículo no fue encontrado.');
        }

        // Ajustar la URL de la imagen solo si existe
        if (!empty($vehiculo->imagen_url)) {
            $vehiculo->imagen_url = asset('storage/' . $vehiculo->imagen_url);
        }

        // Devolver la vista con los datos del vehículo
        return view('Usuario.vehiculo', compact('vehiculo'));
    }
    public function comprarShow($id)
    {
        // Buscar el vehículo junto con su propietario
        $vehiculo = Vehiculo::obtenerPropietariosPorPlaca($id);

        // Verificar si el vehículo existe
        if (!$vehiculo) {
            // Retornar error 404 si el vehículo no fue encontrado
            abort(404, 'El vehículo no fue encontrado.');
        }

        // Ajustar la URL de la imagen solo si existe
        if (!empty($vehiculo->imagen_url)) {
            $vehiculo->imagen_url = asset('storage/' . $vehiculo->imagen_url);
        }

        // Devolver la vista con los datos del vehículo
        return view('Usuario.pagar', compact('vehiculo'));
    }
    public function favoritos()
    {
        // Obtener usuario_id de la cookie
        $id_usuario = Cookie::get('usuario_id');

        if (!$id_usuario) {
            return redirect()->route('login')->withErrors(['message' => 'No se ha iniciado sesión.']);
        }

        // Obtener los favoritos desde el modelo
        $favoritos = Favorito::obtenerFavoritos($id_usuario);

        if (!$favoritos || count($favoritos) === 0) {
            return view('Usuario.favoritos', ['favoritos' => [], 'mensaje' => 'El usuario no tiene favoritos.']);
        }

        // Modificar URL de las imágenes
        foreach ($favoritos as $favorito) {
            $favorito->imagen_url = asset('storage/' . $favorito->imagen_url);
        }

        // Retornar la vista con los datos
        return view('Usuario.favoritos', ['favoritos' => $favoritos]);
    }

    public function agregarFavorito($placa)
    {
        $id_usuario = Cookie::get('usuario_id');
        try {
            // Llamar al método del modelo
            $favorito = User::agregarAutosFavoritos($id_usuario, $placa);
            if ($id_usuario) {
                // Responder con un mensaje de éxito
                return response()->json([
                    'success' => true,
                    'message' => 'El vehículo se agregó a favoritos correctamente.',
                    'data' => $favorito
                ]);
            }
        } catch (\Exception $e) {
            // Manejar errores y devolver una respuesta con el mensaje de error
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
    public function eliminarFavorito($placa)
    {
        $id_usuario = Cookie::get('usuario_id');

        try {
            $favorito = Favorito::eliminarFavoritos($id_usuario, $placa);

            if ($favorito) {
                return response()->json([
                    'success' => true,
                    'message' => 'El vehículo fue eliminado de tus favoritos.',
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'El vehículo no se encontró en tus favoritos.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ocurrió un error al intentar eliminar el favorito.',
            ], 500);
        }
    }



    public function indexVender()
    {
        return view("Usuario.vender");
    }
    public function store(Request $request)
    {
        try {
            // Validación de los datos del formulario
            $request->validate([
                'placa' => 'required|unique:vehiculo|max:10',
                'num_motor' => 'required',
                'anio' => 'required|integer',
                'marca' => 'required',
                'modelo' => 'required',
                'precio' => 'required|numeric',
                'kilometraje' => 'required|numeric',
                'cilindraje' => 'required|numeric',
                'transmision' => 'required',
                'combustible' => 'required',
                'color_exterior' => 'required',
                'color_interior' => 'required',
                'imagen_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Subida de la imagen
            if ($request->hasFile('imagen_url')) {
                $image = $request->file('imagen_url');
                $marca = $request->marca;
                $destinationPath = public_path("img/Vehiculos/$marca");

                // Crear el directorio si no existe
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move($destinationPath, $imageName);

                // Llamar al procedimiento almacenado desde el modelo
                $mensaje = Vehiculo::registrarVehiculo(
                    $request->placa,
                    $request->num_motor,
                    $request->anio,
                    $request->marca,
                    $request->modelo,
                    $request->precio,
                    $request->kilometraje,
                    $request->cilindraje,
                    $request->transmision,
                    $request->combustible,
                    $request->color_exterior,
                    $request->color_interior,
                    "img/Vehiculos/$marca/$imageName"
                );
            }

            // Responder con el mensaje de éxito
            return response()->json(['message' => $mensaje], 200);

        } catch (\Exception $e) {
            // En caso de error, retornar el mensaje de excepción
            return response()->json(['message' => $e->getMessage(), 'trace' => $e->getTrace()], 400);
        }
    }
    public function configuracion()
    {
        return view('usuario.configuracion'); // Retorna la vista de configuración
    }
}
