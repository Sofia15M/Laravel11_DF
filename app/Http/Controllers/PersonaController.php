<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function index()
    {
        $personas = DB::select("
            SELECT ID_Administrador AS ID, Foto_Administrador AS Foto, 'administradors' AS Tabla FROM administradors
            UNION ALL
            SELECT Id_Domiciliario AS ID, Nombre_Recidente AS Foto, 'domiciliarios' AS Tabla FROM domiciliarios
            UNION ALL
            SELECT ID_PersonalL AS ID, Foto_PersonalL AS Foto, 'empleados' AS Tabla FROM empleados
            UNION ALL
            SELECT ID_Propietario AS ID, Foto_Propietario AS Foto, 'propietarios' AS Tabla FROM propietarios
            UNION ALL
            SELECT ID_Residente AS ID, Foto_Residente AS Foto, 'residentes' AS Tabla FROM residentes
            UNION ALL
            SELECT ID_Vigilante AS ID, Foto_Vigilante AS Foto, 'vigilantes' AS Tabla FROM vigilantes
            UNION ALL
            SELECT ID_Visitante AS ID, Foto_Visitante AS Foto, 'visitantes' AS Tabla FROM visitantes
        ");

        return view('personas.index', compact('personas'));
    }
}
