<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
class CompraController extends Controller
{
    public function simulate(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        // Lógica para simulación de compra
        // Aquí podrías integrar lógica con un sistema bancario externo

        return view('compra.success', ['vehiculo' => $vehiculo]);
    }
}
