<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Favorito extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'favoritos';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'usuario_id',
        'placa',
        'fecha_agregado',
    ];
    public static function obtenerFavoritos($id)
    {
        // Ejecutar el procedimiento almacenado correctamente
        $resultado = DB::select('CALL favortito(?,?,?)', [$id, "", "ver"]);

        // Verificar si hay resultados
        return $resultado;
    }
    public static function eliminarFavoritos($id, $placa)
    {
        // Ejecutar el procedimiento almacenado para eliminar un favorito
        $resultado = DB::select('CALL favortito(?,?,?)', [$id, $placa, "eliminar"]);

        // Devolver el resultado
        return $resultado;
    }

}
