<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ApartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartamentos = Apartamento::all();
        return view('apartamentos.index', compact('apartamentos'));
    }

    public function pdf(){
        $apartamentos=Apartamento::all();
        $pdf = Pdf::loadView('apartamentos.pdf', compact('apartamentos'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('apartamentos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_Apartamento' => 'required|string|max:255',
            'Descripcion_Apartamento' => 'required|string|max:255',
            'ID_UNIDAD' => 'required|integer',
            'ID_Propietario' => 'required|integer',
        ]);

        Apartamento::create([
            'ID_Apartamento' => $request->input('ID_Apartamento'),
            'Descripcion_Apartamento' => $request->input('Descripcion_Apartamento'),
            'ID_UNIDAD' => $request->input('ID_UNIDAD'),
            'ID_Propietario' => $request->input('ID_Propietario')
        ]);

        return redirect()->route('apartamentos.index');
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
        $apartamento = Apartamento::findOrFail($id);
        return view('apartamentos.edit', compact('apartamento'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'Descripcion_Apartamento' => 'required|string|max:255',
            'ID_Propietario' => 'required|integer',
        ]);
        $apartamento = Apartamento::findOrFail($id);
        // Actualizar los datos del estudiante
        $apartamento->update($request->all());
        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('apartamentos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
