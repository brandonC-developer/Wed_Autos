<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'usuario';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'usuario_id',
        'username',
        'clave',
        'email',
        'role',
    ];
}
