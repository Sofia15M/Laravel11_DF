<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
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
        $visitantes = Visitante::where('status', 'active')->paginate(10);
        return view('visitantes.index', compact('visitantes'));
    }

    public function inactive()
    {
        $visitantes = Visitante::where('status', 'inactive')->paginate(10);
        return view('visitantes.inactive', compact('visitantes'));
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
        $visitantesIds = Visitante::pluck('ID_Visitante')->toArray(); // Obtener los IDs de visitantes
        $apartamentos = Apartamento::all();
        return view('visitantes.create', compact('visitantesIds', 'apartamentos'));

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
            'ID_Visitante' => 'required|integer|unique:visitantes,ID_Visitante',
            'ID_Apartamento' => 'required|integer|exists:apartamentos,ID_Apartamento',
            'Hora_Ingreso' => 'required|date',
            'Hora_Salida' => 'nullable|date' 
        ]);

        $path = null;
        if ($request->hasFile('Foto_Visitante')) {
            $image = $request->file('Foto_Visitante');
            $path = $image->store('fotos_visitantes', 'public');
        }

        $visitante = new Visitante([
            'ID_Visitante' => $request->ID_Visitante,
            'Nombre_Visitante' => $request->Nombre_Visitante,
            'Tel_Cel_Visitante' => $request->Tel_Cel_Visitante,
            'ID_Apartamento' => $request->ID_Apartamento, // Asegúrate de guardar este campo
            'Hora_Ingreso' => $request->Hora_Ingreso,
            'Hora_Salida' => $request->Hora_Salida,
            'Foto_Visitante' => $path
        ]);

        $visitante->save();

        return redirect()->route('visitantes.index')
            ->with('mensaje', 'Visitante creado con éxito')
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
        $visitante = Visitante::findOrFail($id);
        return view('visitantes.edit', compact('visitante'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'Nombre_Visitante' => 'required|string|max:255',
                'Tel_Cel_Visitante' => 'required|string|max:255',
            ]);

            $visitante = Visitante::findOrFail($id);

            $visitante->update($request->all());

            return redirect()->route('visitantes.index')
                ->with('mensaje', 'Visitante actualizado con éxito')
                ->with('icon', 'success');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('mensaje', 'Error actualizando el visitante: ' . $e->getMessage())
                ->with('icon', 'error');
        }
    }


    public function updateStatus($id)
    {
        try {
            $visitante = Visitante::findOrFail($id);
            $visitante->status = 'inactive';
            $visitante->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function activateStatus($id)
    {
        try {
            $visitante = Visitante::findOrFail($id);
            $visitante->status = 'active'; // Cambia el status según tu lógica
            $visitante->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
