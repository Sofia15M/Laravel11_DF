<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Http\Request;

class UnidadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unidads = Unidad::all();
        return view('unidads.index', compact('unidads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $unidad = Unidad::findOrFail($id);
        return view('unidads.edit', compact('unidad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre_Unidad' => 'required|string|max:255',
            'Tel_Unidad' => 'required|string|max:255',
            'Direccion_Unidad' => 'required|string|max:255',
            'Cantida_Apartamentos_Unidad' => 'required|integer',
        ]);

        $unidad = Unidad::findOrFail($id);
        $unidad->update($request->all());
        return redirect()->route('unidads.index')
            ->with('mensaje', 'La informacion de la unidad actualizada con éxito')
            ->with('icon', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
