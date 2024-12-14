<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculo';
    protected $primaryKey = 'placa';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'placa',
        'num_motor',
        'anio',
        'marca',
        'modelo',
        'precio',
        'kilometraje',
        'cilindraje',
        'transmision',
        'combustible',
        'color_exterior',
        'color_interior',
        'imagen_url',
        'fecha_registro',
    ];

    public static function obtenerPropietariosPorPlaca($placa)
    {
        $resultado = DB::select('CALL Datos(?)', [$placa]);

        // Verificar si hay resultados y devolver el primero como objeto
        return $resultado ? (object) $resultado[0] : null;
    }
    // Función del modelo Vehiculo para registrar un vehículo
    public static function registrarVehiculo($placa, $num_motor, $anio, $marca, $modelo, $precio, $kilometraje, $cilindraje, $transmision, $combustible, $color_exterior, $color_interior, $imagen_url)
    {
        try {
            // Llamada al procedimiento almacenado
            $resultado = DB::select('CALL registrarVehiculo(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                $placa,
                $num_motor,
                $anio,
                $marca,
                $modelo,
                $precio,
                $kilometraje,
                $cilindraje,
                $transmision,
                $combustible,
                $color_exterior,
                $color_interior,
                $imagen_url
            ]);

            // Verificar si el procedimiento devuelve resultados
            if ($resultado) {
                return $resultado[0]->mensaje ?? 'Vehículo registrado correctamente';
            } else {
                return 'No se obtuvo respuesta del procedimiento almacenado.';
            }

        } catch (\Exception $e) {
            // En caso de error, devolver el mensaje de excepción
            return $e->getMessage();
        }
    }


}
