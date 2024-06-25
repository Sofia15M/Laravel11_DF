<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartamento extends Model
{
    use HasFactory;

    protected $primaryKey = 'ID_Apartamento';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'ID_Apartamento',
        'Descripcion_Apartamento',
        'ID_UNIDAD',
        'ID_Propietario'
    ];

    public $timestamps = false;

}
