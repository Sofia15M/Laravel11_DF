<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administradors = Administrador::all();
        return view('administradors.index', compact('administradors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administradors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_Administrador' => 'required|string|max:255', // Cambia `string` por `integer` si el ID es un número entero
            'Foto_Administrador' => 'nullable|string|max:255',
            'Nombre_Administrador' => 'required|string|max:255',
            'Edad_Administrador' => 'nullable|integer',
            'Cargo_Administrador' => 'nullable|string|max:255',
            'Direccion_Administrador' => 'nullable|string|max:255',
            'Tel_Cel_Administrador' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer',
        ]);

        // Crear el registro del vigilante
        Administrador::create([
            'ID_Administrador' => $request->input('ID_Administrador', uniqid()), // Proporciona un valor único si no se proporciona
            'Foto_Administrador' => $request->input('Foto_Administrador', 'default.jpg'),
            'Nombre_Administrador' => $request->input('Nombre_Administrador'),
            'Edad_Administrador' => $request->input('Edad_Administrador'),
            'Cargo_Administrador' => $request->input('Cargo_Administrador'),
            'Direccion_Administrador' => $request->input('Direccion_Administrador'),
            'Tel_Cel_Administrador' => $request->input('Tel_Cel_Administrador'),
            'Tiempo_trabajo' => $request->input('Tiempo_trabajo'),
            'Fecha_Registro' => $request->input('Fecha_Registro'),
            'ID_UNIDAD' => $request->input('ID_UNIDAD'),
        ]);

        return redirect()->route('administradors.index');
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
        $administrador = Administrador::findOrFail($id);
        return view('administradors.edit', compact('administrador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Foto_Administrador' => 'nullable|string|max:255',
            'Nombre_Administrador' => 'required|string|max:255',
            'Edad_Administrador' => 'nullable|integer',
            'Cargo_Administrador' => 'nullable|string|max:255',
            'Direccion_Administrador' => 'nullable|string|max:255',
            'Tel_Cel_Administrador' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date'
        ]);

        $administrador = Administrador::findOrFail($id);
        $administrador->update($request->all());
        return redirect()->route('administradors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
