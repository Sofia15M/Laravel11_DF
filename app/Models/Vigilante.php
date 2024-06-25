<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vigilante extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Vigilante';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Vigilante',
        'Foto_Vigilante',
        'Nombre_Vigilante',
        'Edad_Vigilante',
        'Cargo_Vigilante',
        'Direccion_Vigilante',
        'Tel_Cel_Vigilante',
        'Tiempo_trabajo',
        'id_unidad'
    ];

    public $timestamps = false;
}
