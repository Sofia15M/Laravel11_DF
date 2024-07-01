<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

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

    public function pdf(){
        $administradors=Administrador::all();
        $pdf = Pdf::loadView('administradors.pdf', compact('administradors'));
        return $pdf->stream();
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
            'ID_Administrador' => 'required|integer', // Cambia `string` por `integer` si el ID es un número entero
            'Foto_Administrador' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Nombre_Administrador' => 'required|string|max:255',
            'Edad_Administrador' => 'nullable|integer',
            'Cargo_Administrador' => 'nullable|string|max:255',
            'Direccion_Administrador' => 'nullable|string|max:255',
            'Tel_Cel_Administrador' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer'
        ]);

        if ($request->hasFile('Foto_Administrador')) {
            $image = $request->file('Foto_Administrador');
            $path = $image->store('fotos_administrador', 'public');
        }

        $administrador = new Administrador([
            'ID_Administrador' => $request->get('ID_Administrador'), // Proporciona un valor único si no se proporciona
            'Foto_Administrador' => $path ?? null,
            'Nombre_Administrador' => $request->get('Nombre_Administrador'),
            'Edad_Administrador' => $request->get('Edad_Administrador'),
            'Cargo_Administrador' => $request->get('Cargo_Administrador'),
            'Direccion_Administrador' => $request->get('Direccion_Administrador'),
            'Tel_Cel_Administrador' => $request->get('Tel_Cel_Administrador'),
            'Tiempo_trabajo' => $request->get('Tiempo_trabajo'),
            'Fecha_Registro' => $request->get('Fecha_Registro'),
            'ID_UNIDAD' => $request->get('ID_UNIDAD'),
        ]);

        $administrador->save();

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
