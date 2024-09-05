<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class ApartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartamentos = Apartamento::where('status', 'active')->get();
        return view('apartamentos.index', compact('apartamentos'));
    }

    public function inactive()
    {
        $apartamentos = Apartamento::where('status', 'inactive')->get();
        return view('apartamentos.inactive', compact('apartamentos'));
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

        return redirect()->route('apartamentos.index')
        ->with('mensaje', 'Apartamento creado con exito')
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
        try {
            $apartamento = Apartamento::findOrFail($id);
            return view('apartamentos.edit', compact('apartamento'));
        } catch (Exception $e) {
            // Manejar la excepción
            return back()->withError('Error al editar el apartamento: ' . $e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'Descripcion_Apartamento' => 'required|string|max:255',
                'ID_Propietario' => 'required|integer',
            ]);

            $apartamento = Apartamento::findOrFail($id);
            $apartamento->update($request->all());

            return redirect()->route('apartamentos.index')
        ->with('mensaje', 'Apartamento actualizado con exito')
        ->with('icon', 'success');
        } catch (Exception $e) {
            // Manejar la excepción
            return redirect()->route('apartamentos.index')
            ->with('mensaje', 'Apartamento no acascascasc con exito')
            ->with('icon', 'error');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {


    }
    public function desactivar(string $id)
    {
        $apartamento = Apartamento::findOrFail($id);
        $apartamento->status = 'inactivo';

        $apartamento->save();
        return redirect()->route('apartamentos.index')
        ->with('mensaje', 'Aparraento elimando con exiur')
        ->with('icon', 'error');

    }


}
