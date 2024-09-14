<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Propietario;
use Exception;

class ApartamentoController extends Controller
{

    //Muestra el listado de los apartamentos activos.
    public function index(Request $request)
    {

        $query = Apartamento::where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Apartamento', 'like', '%' . $request->search . '%');
            });
        }

        $apartamentos = $query->paginate(10);

        return view('apartamentos.index', compact('apartamentos'));
    }

    //Muestra el listado de los apartamentos inactivos.
    public function inactive(Request $request)
    {

        $query = Apartamento::where('status', 'inactive');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Apartamento', 'like', '%' . $request->search . '%');
            });
        }

        $apartamentos = $query->paginate(10);

        return view('apartamentos.inactive', compact('apartamentos'));

    }

    // Genera los PDF de todos los apartmentos, ademas lo redirige.
    public function pdf()
    {
        $apartamentos = Apartamento::all();
        $pdf = Pdf::loadView('apartamentos.pdf', compact('apartamentos'));
        return $pdf->stream();
    }

    //Funcion re-dirige a la vista Crear
    public function create()
    {
        $apartamentosIds = Apartamento::pluck('ID_Apartamento')->toArray(); // Obtener los IDs de apartamentos
        $propietarios = Propietario::all(); // Obtener la lista de propietarios

        // Pasar ambas variables a la vista
        return view('apartamentos.create', compact('apartamentosIds', 'propietarios'));
    }

    //Funcion guarda la infomacion cuando se crea un nuevo aparatemento
    public function store(Request $request)
    {
        $request->validate([
            'ID_Apartamento' => 'required|string|max:255',
            'Descripcion_Apartamento' => 'required|string|max:255',
            'ID_UNIDAD' => 'required|integer',
            'ID_Propietario' => 'required|integer',
        ]);

        Apartamento::create($request->only([
            'ID_Apartamento',
            'Descripcion_Apartamento',
            'ID_UNIDAD',
            'ID_Propietario'
        ]));

        return redirect()->route('apartamentos.index')
            ->with('mensaje', 'Apartamento creado con éxito')
            ->with('icon', 'success');
    }


    //Funcion re-dirige a la vista actualizar
    public function edit(string $id)
    {
        $apartamento = Apartamento::findOrFail($id);
        $propietarios = Propietario::all();
        return view('apartamentos.edit', compact('apartamento', 'propietarios'));
    }

    //Funcion de actualizar
    public function update(Request $request, string $id)
    {
        $request->validate([
            'Descripcion_Apartamento' => 'required|string|max:255',
            'ID_Propietario' => 'required|integer',
        ]);

        $apartamento = Apartamento::findOrFail($id);
        $apartamento->update($request->only([
            'Descripcion_Apartamento',
            'ID_Propietario'
        ]));

        return redirect()->route('apartamentos.index')
            ->with('mensaje', 'Apartamento actualizado con éxito')
            ->with('icon', 'success');
    }

    //Funcion de Desativar
    public function updateStatus($id)
    {
        try {
            $apartamento = Apartamento::findOrFail($id);
            $apartamento->status = 'inactive';
            $apartamento->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    //Funcion de Activar
    public function activateStatus($id)
    {
        try {
            $apartamento = Apartamento::findOrFail($id);
            $apartamento->status = 'active'; // Cambia el status según tu lógica
            $apartamento->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
