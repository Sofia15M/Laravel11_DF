<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $propietarios = Propietario::where('status', 'active')->paginate(10);
        return view('propietarios.index', compact('propietarios'));
    }

    public function inactive()
    {
        $propietarios = Propietario::where('status', 'inactive')->paginate(10);
        return view('propietarios.inactive', compact('propietarios'));
    }

    public function pdf(){
        $propietarios=Propietario::all();
        $pdf = Pdf::loadView('propietarios.pdf', compact('propietarios'));
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('propietarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_Propietario' => 'required|integer',
            'Foto_Propietario' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Nombre_Propietario' => 'required|string|max:255',
            'Tel_Cel_Propietario' => 'required|string|max:255'
        ]);

        if ($request->hasFile('Foto_Propietario')) {
            $image = $request->file('Foto_Propietario');
            $path = $image->store('fotos_propietarios', 'public');
        }

        // Crear el propietario pero aún no está guardado
        $propietario = new Propietario([
            'ID_Propietario' => $request->get('ID_Propietario', uniqid()),
            'Nombre_Propietario' => $request->get('Nombre_Propietario'),
            'Tel_Cel_Propietario' => $request->get('Tel_Cel_Propietario'),
            'Foto_Propietario' => $path ?? null,
        ]);

        // Aquí se guarda el propietario en la base de datos
        $propietario->save();

        return redirect()->route('propietarios.index')
            ->with('mensaje', 'Propietario creado con éxito')
            ->with('icon', 'success');
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
        $propietario = Propietario::findOrFail($id);
        return view('propietarios.edit', compact('propietario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Nombre_Propietario' => 'required|string|max:255',
            'Tel_Cel_Propietario' => 'required|string|max:255',
        ]);

        $propietario = Propietario::findOrFail($id);

        // Actualizar los datos del estudiante
        $propietario->update($request->all());

        // Redireccionar a la vista de listado de estudiantes
        return redirect()->route('propietarios.index')
            ->with('mensaje', 'Propietario actualizado con éxito')
            ->with('icon', 'success');
    }

}
