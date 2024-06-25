<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_PersonalL';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_PersonalL',
        'Foto_PersonalL',
        'Nombre_PersonalL',
        'Edad_PersonalL',
        'Cargo_PersonalL',
        'Direccion_PersonalL',
        'Tel_Cel_PersonalL',
        'Tiempo_trabajo',
        'ID_UNIDAD'
    ];

    public $timestamps = false;
}
