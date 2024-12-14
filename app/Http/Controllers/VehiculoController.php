<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class VehiculoController extends Controller
{
    public function index()
    {
        return view("vehiculos.vender");
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
                'imagen_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
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



    public function show($id)
    {
        $vehiculos = Vehiculo::find($id);

        // Verificar si el vehículo existe
        if (!$vehiculos) {
            // Manejar el caso donde el vehículo no exista
            return redirect()->back()->withErrors('El vehículo no fue encontrado.');
        }

        // Ajustar la URL de la imagen
        $vehiculos->imagen_url = asset('storage/' . $vehiculos->imagen_url);

        // Devolver la vista con los datos del vehículo
        return view('vehiculos.descripcion', ['vehiculo' => $vehiculos]);
    }

}