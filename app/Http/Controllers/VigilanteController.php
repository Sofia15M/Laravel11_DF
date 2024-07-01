<?php

namespace App\Http\Controllers;

use App\Models\Vigilante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class VigilanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vigilantes = Vigilante::all();
        return view('vigilantes.index', compact('vigilantes'));
    }

    public function pdf(){
        $vigilantes=Vigilante::all();
        $pdf = Pdf::loadView('vigilantes.pdf', compact('vigilantes'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vigilantes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_Vigilante' => 'required|integer',
            'Foto_Vigilante' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Nombre_Vigilante' => 'required|string|max:255',
            'Edad_Vigilante' => 'nullable|integer',
            'Cargo_Vigilante' => 'nullable|string|max:255',
            'Direccion_Vigilante' => 'nullable|string|max:255',
            'Tel_Cel_Vigilante' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer',
        ]);

        if ($request->hasFile('Foto_Vigilante')) {
            $image = $request->file('Foto_Vigilante');
            $path = $image->store('fotos_vigilantesr', 'public');
        }

        $vigilante = new Vigilante([
            'ID_Vigilante' => $request->get('ID_Vigilante', uniqid()), // Proporciona un valor único si no se proporciona
            'Foto_Vigilante' => $path ?? null,
            'Nombre_Vigilante' => $request->get('Nombre_Vigilante'),
            'Edad_Vigilante' => $request->get('Edad_Vigilante'),
            'Cargo_Vigilante' => $request->get('Cargo_Vigilante'),
            'Direccion_Vigilante' => $request->get('Direccion_Vigilante'),
            'Tel_Cel_Vigilante' => $request->get('Tel_Cel_Vigilante'),
            'Tiempo_trabajo' => $request->get('Tiempo_trabajo'),
            'Fecha_Registro' => $request->get('Fecha_Registro'),
            'ID_UNIDAD' => $request->get('ID_UNIDAD'),
        ]);

        $vigilante->save();

        return redirect()->route('vigilantes.index');

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
        $vigilante = Vigilante::findOrFail($id);
        return view('vigilantes.edit', compact('vigilante'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Foto_Vigilante' => 'nullable|string|max:255',
            'Nombre_Vigilante' => 'required|string|max:255',
            'Edad_Vigilante' => 'nullable|integer',
            'Cargo_Vigilante' => 'nullable|string|max:255',
            'Direccion_Vigilante' => 'nullable|string|max:255',
            'Tel_Cel_Vigilante' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
        ]);

        $vigilante = Vigilante::findOrFail($id);

        // Actualizar los datos del estudiante
        $vigilante->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('vigilantes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
