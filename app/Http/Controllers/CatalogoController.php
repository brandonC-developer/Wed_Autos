<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class CatalogoController extends Controller
{
    public function index(Request $request)
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
        return view('vehiculos.buscar', ['vehiculos' => $vehiculos]);
    }


}
