<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitante extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Visitante';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Visitante',
        'Foto_Visitante',
        'Nombre_Visitante',
        'Tel_Cel_Visitante',
        'Fecha_Registro',
        'Hora_Ingreso',
        'Hora_Salida',
        'ID_Apartamento',
        'status',
    ];

    public $timestamps = false;
}
