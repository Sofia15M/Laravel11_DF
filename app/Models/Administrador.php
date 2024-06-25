<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrador extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Administrador';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Administrador',
        'Foto_Administrador',
        'Nombre_Administrador',
        'Edad_Administrador',
        'Cargo_Administrador',
        'Direccion_Administrador',
        'Tel_Cel_Administrador',
        'Tiempo_trabajo',
        'ID_UNIDAD'
    ];

    public $timestamps = false;
}
