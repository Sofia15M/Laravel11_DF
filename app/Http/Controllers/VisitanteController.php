<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $visitantes = Visitante::all();
        return view('visitantes.index', compact('visitantes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('visitantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Nombre_Visitante' => 'required|string|max:255',
            'Tel_Cel_Visitante' => 'required|string|max:255',
            'ID_Apartamento' => 'required|integer',
        ]);

        Visitante::create([
            'ID_Visitante' => $request->input('ID_Visitante', uniqid()), // Proporciona un valor único
            'Nombre_Visitante' => $request->input('Nombre_Visitante'),
            'Tel_Cel_Visitante' => $request->input('Tel_Cel_Visitante'),
            'ID_Apartamento' => $request->input('ID_Apartamento'),
            'Hora_Ingreso' => $request->input('Hora_Ingreso'),
            'Hora_Salida' => $request->input('Hora_Salida'),
            'Foto_Visitante' => $request->input('Foto_Visitante', 'default.jpg'), // Valor predeterminado si no se proporciona
        ]);

        return redirect()->route('visitantes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $visitante = Visitante::findOrFail($id);
        return view('visitantes.edit', compact('visitante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre_Visitante' => 'required|string|max:255',
            'Tel_Cel_Visitante' => 'required|string|max:255',
            'ID_Apartamento' => 'required|integer',
        ]);

        $visitante = Visitante::findOrFail($id);

        // Actualizar los datos del estudiante
        $visitante->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('visitantes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
