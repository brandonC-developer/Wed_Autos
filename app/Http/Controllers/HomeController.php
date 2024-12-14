<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use illuminate\Contracts\View\View;
use App\Models\Vehiculo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $vehiculosDestacados = Vehiculo::orderBy('fecha_registro', 'desc')->take(6)->get();

        foreach ($vehiculosDestacados as $vehiculo) {
            $vehiculo->imagen_url = asset('storage/' . $vehiculo->imagen_url);  // Genera la URL correcta
        }

        return view('home', [
            'vehiculos_destacados' => $vehiculosDestacados,
        ]);
    }
}
