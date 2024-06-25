<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Propietario';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Propietario',
        'Foto_Propietario',
        'Nombre_Propietario',
        'Tel_Cel_Propietario',
        'Fecha_Registro',
        'Foto_Residente'
    ];

    public $timestamps = false;

}
