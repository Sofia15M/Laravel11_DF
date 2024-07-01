<?php

namespace App\Http\Controllers;

use App\Models\Visitante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf(){
        $visitantes=Visitante::all();
        $pdf = Pdf::loadView('visitantes.pdf', compact('visitantes'));
        return $pdf->stream();
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
            'Foto_Visitante' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Tel_Cel_Visitante' => 'required|string|max:255',
            'ID_Apartamento' => 'required|integer',
        ]);

        if ($request->hasFile('Foto_Visitante')) {
            $image = $request->file('Foto_Visitante');
            $path = $image->store('fotos_visitantes', 'public');
        }

        $visitante = new Visitante([
            'ID_Visitante' => $request->get('ID_Visitante'), // Proporciona un valor único
            'Nombre_Visitante' => $request->get('Nombre_Visitante'),
            'Tel_Cel_Visitante' => $request->get('Tel_Cel_Visitante'),
            'ID_Apartamento' => $request->get('ID_Apartamento'),
            'Hora_Ingreso' => $request->get('Hora_Ingreso'),
            'Hora_Salida' => $request->get('Hora_Salida'),
            'Foto_Visitante' => $path ?? null,
        ]);

        $visitante->save();

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
