<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Residente extends Model
{
    use HasFactory;

    protected $table = 'residentes';
    protected $primaryKey = 'ID_Residente';

    protected $fillable = [
        'ID_Residente',
        'Nombre_Residente',
        'Tel_Cel_Residente',
        'ID_Apartamento',
        'Foto_Residente', // Asegúrate de incluirlo aquí
    ];

    public $incrementing = false; // Si estás manejando manualmente el ID
    protected $keyType = 'string';

    public $timestamps = false; // Desactivar timestamps

    public function apartamento()
    {
        //
    }
}
