<?php

namespace App\Http\Controllers;

use App\Models\Residente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf(){
        $residentes=Residente::all();
        $pdf = Pdf::loadView('residentes.pdf', compact('residentes'));
        return $pdf->stream();
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
        $request->validate([
            'ID_Residente' => 'required|integer',
            'Nombre_Residente' => 'required|string|max:255',
            'Foto_Residente' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Tel_Cel_Residente' => 'required|string|max:15',
            'ID_Apartamento' => 'required|string|max:10',
        ]);

        if ($request->hasFile('Foto_Residente')) {
            $image = $request->file('Foto_Residente');
            $path = $image->store('fotos_residentes', 'public');
        }

        $residente = new Residente([
            'ID_Residente' => $request->get('ID_Residente'),
            'Nombre_Residente' => $request->get('Nombre_Residente'),
            'Foto_Residente' => $path ?? null,
            'Tel_Cel_Residente' => $request->get('Tel_Cel_Residente'),
            'ID_Apartamento' => $request->get('ID_Apartamento'),
        ]);

        $residente->save();

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
