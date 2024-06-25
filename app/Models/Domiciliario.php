<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domiciliario extends Model
{
    use HasFactory;

    protected $primaryKey = 'Id_Domiciliario';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Id_Domiciliario',
        'Nombre_Domiciliario',
        'Nombre_Recidente',
        'id_Apartamento'
    ];

    public $timestamps = false;
}
