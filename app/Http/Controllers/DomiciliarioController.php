<?php

namespace App\Http\Controllers;

use App\Models\Domiciliario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DomiciliarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $domiciliarios = Domiciliario::all();
        return view('domiciliarios.index', compact('domiciliarios'));
    }

    public function pdf(){
        $domiciliarios=Domiciliario::all();
        $pdf = Pdf::loadView('domiciliarios.pdf', compact('domiciliarios'));
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('domiciliarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Id_Domiciliario' => 'required|string|max:255',
            'Nombre_Domiciliario' => 'required|string|max:255',
            'Nombre_Recidente' => 'required|string|max:255',
            'id_Apartamento' => 'required|integer'
        ]);

        Domiciliario::create([
            'Id_Domiciliario' => $request->input('Id_Domiciliario'),
            'Nombre_Domiciliario' => $request->input('Nombre_Domiciliario'),
            'Nombre_Recidente' => $request->input('Nombre_Recidente'),
            'id_Apartamento' => $request->input('id_Apartamento')
        ]);

        return redirect()->route('domiciliarios.index');

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
        $domiciliario = Domiciliario::findOrFail($id);
        return view('domiciliarios.edit', compact('domiciliario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre_Domiciliario' => 'required|string|max:255',
            'Nombre_Recidente' => 'required|string|max:255',
            'id_Apartamento' => 'required|integer'
        ]);

        $domiciliario = Domiciliario::findOrFail($id);
        $domiciliario->update($request->all());
        return redirect()->route('domiciliarios.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
