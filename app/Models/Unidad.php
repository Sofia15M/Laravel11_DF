<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidads';
    protected $primaryKey = 'ID_UNIDAD';
    protected $keyType = 'string';
    public $timestamps = false;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'Nombre_Unidad',
        'Tel_Unidad',
        'Direccion_Unidad',
        'Cantida_Apartamentos_Unidad',
        'Foto_Unidad',
    ];
}
