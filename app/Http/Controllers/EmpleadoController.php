<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }

    public function pdf(){
        $empleados=Empleado::all();
        $pdf = Pdf::loadView('empleados.pdf', compact('empleados'));
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empleados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ID_PersonalL' => 'required|integer',
            'Foto_PersonalL' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'Nombre_PersonalL' => 'required|string|max:255',
            'Edad_PersonalL' => 'nullable|integer',
            'Cargo_PersonalL' => 'nullable|string|max:255',
            'Direccion_PersonalL' => 'nullable|string|max:255',
            'Tel_Cel_PersonalL' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer',
        ]);

        if ($request->hasFile('Foto_PersonalL')) {
            $image = $request->file('Foto_PersonalL');
            $path = $image->store('fotos_empleados', 'public');
        }

        $empleado = new Empleado([
            'ID_PersonalL' => $request->get('ID_PersonalL', uniqid()), // Proporciona un valor único si no se proporciona
            'Foto_PersonalL' => $path ?? null,
            'Nombre_PersonalL' => $request->get('Nombre_PersonalL'),
            'Edad_PersonalL' => $request->get('Edad_PersonalL'),
            'Cargo_PersonalL' => $request->get('Cargo_PersonalL'),
            'Direccion_PersonalL' => $request->get('Direccion_PersonalL'),
            'Tel_Cel_PersonalL' => $request->get('Tel_Cel_PersonalL'),
            'Tiempo_trabajo' => $request->get('Tiempo_trabajo'),
            'Fecha_Registro' => $request->get('Fecha_Registro'),
            'ID_UNIDAD' => $request->get('ID_UNIDAD')
        ]);

        $empleado->save();

        return redirect()->route('empleados.index');
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
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Foto_PersonalL' => 'nullable|string|max:255',
            'Nombre_PersonalL' => 'required|string|max:255',
            'Edad_PersonalL' => 'nullable|integer',
            'Cargo_PersonalL' => 'nullable|string|max:255',
            'Direccion_PersonalL' => 'nullable|string|max:255',
            'Tel_Cel_PersonalL' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date'
        ]);

        $empleado = Empleado::findOrFail($id);
        $empleado->update($request->all());
        return redirect()->route('empleados.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
