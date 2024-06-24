<?php

namespace App\Http\Controllers;

use App\Models\Residente;
use Illuminate\Http\Request;

class ResidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $residentes = Residente::all();
        return view('residentes.index', compact('residentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('residentes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'Nombre_Residente' => 'required|string|max:255',
            'Tel_Cel_Residente' => 'required|string|max:255',
            'ID_Apartamento' => 'required|integer',
        ]);

        Residente::create([
            'ID_Residente' => $request->input('ID_Residente', uniqid()), // Proporciona un valor único
            'Nombre_Residente' => $request->input('Nombre_Residente'),
            'Tel_Cel_Residente' => $request->input('Tel_Cel_Residente'),
            'ID_Apartamento' => $request->input('ID_Apartamento'),
            'Foto_Residente' => $request->input('Foto_Residente', 'default.jpg'), // Valor predeterminado si no se proporciona
        ]);

        return redirect()->route('residentes.index');
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
        $residente = Residente::findOrFail($id);
        return view('residentes.edit', compact('residente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre_Residente' => 'required|string|max:255',
            'Tel_Cel_Residente' => 'required|string|max:255',
            'ID_Apartamento' => 'required|integer',
        ]);

        $residente = Residente::findOrFail($id);

        // Actualizar los datos del estudiante
        $residente->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('residentes.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $residente = Residente::findOrFail($id);
        $residente->delete();
        return redirect()->route('residentes.index');
    }
}
