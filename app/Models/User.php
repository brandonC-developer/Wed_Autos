<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuario';

    protected $fillable = [
        'usuario_id',
        'username',
        'clave',
        'email',
        'role',
    ];
    public static function agregarAutosFavoritos($id_usuario, $placa)
    {
        try {
            // Ejecutar el procedimiento almacenado
            $resultado = DB::select('CALL AgregarFavorito(?, ?)', [$id_usuario, $placa]);

            // Verificar si hay resultados y devolver el primero como objeto
            return $resultado ? (object) $resultado[0] : null;
        } catch (\Exception $e) {
            // Manejar errores en caso de que el procedimiento lance una excepción
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
