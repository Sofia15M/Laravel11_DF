<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use Carbon\Carbon;
use App\Models\Residente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ResidenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Residente::where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Residente', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Residente', 'like', '%' . $request->search . '%');
            });
        }

        $residentes = $query->paginate(10);

        return view('residentes.index', compact('residentes'));

    }

    public function inactive(Request $request)
    {
        $query = Residente::where('status', 'inactive');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Residente', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Residente', 'like', '%' . $request->search . '%');
            });
        }

        $residentes = $query->paginate(10);

        return view('residentes.inactive', compact('residentes'));
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
        $residentesIds = Residente::pluck('ID_Residente')->toArray(); // Obtener los IDs de apartamentos
        $apartamentos = Apartamento::all();
        return view('residentes.create', compact('residentesIds', 'apartamentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'ID_Residente' => 'required|integer',
            'Foto_Residente' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Permitir imagen como archivo
            'imageData' => 'nullable|string', // Validar el campo para imagen base64
            'Nombre_Residente' => 'required|string|max:255',
            'Tel_Cel_Residente' => 'required|string|max:15',
            'ID_Apartamento' => 'required|string|max:10',
        ]);

        // Obtener y sanear el nombre del residente
        $nombreResidente = $request->get('Nombre_Residente');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreResidente); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen de la cámara (base64) si está presente
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del residente
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_residentes/' . $imageName, $image);

            $path = 'fotos_residentes/' . $imageName;
        }

        // Procesar la imagen cargada desde un archivo
        if ($request->hasFile('Foto_Residente')) {
            $image = $request->file('Foto_Residente');

            // Generar un nombre de archivo basado en el nombre del residente
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_residentes', $imageName, 'public');
        }

        // Crear el residente y asignar los datos
        $residente = new Residente([
            'ID_Residente' => $request->get('ID_Residente'),
            'Foto_Residente' => $path ?? null, // Guardar la ruta de la imagen si existe
            'Nombre_Residente' => $nombreResidente,
            'Tel_Cel_Residente' => $request->get('Tel_Cel_Residente'),
            'ID_Apartamento' => $request->get('ID_Apartamento'),
        ]);

        // Guardar el residente en la base de datos
        $residente->save();

        // Redirigir a la lista de residentes con un mensaje de éxito
        return redirect()->route('residentes.index')
            ->with('mensaje', 'Residente creado con éxito')
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
        $residente = Residente::findOrFail($id);
        $apartamentos = Apartamento::all();
        return view('residentes.edit', compact('residente', 'apartamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los campos del formulario
        $request->validate([
            'Foto_Residente_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen capturada desde la cámara (base64)
            'Nombre_Residente' => 'required|string|max:255',
            'Tel_Cel_Residente' => 'required|string|max:15',
            'ID_Apartamento' => 'required|string|max:10',
        ]);

        // Buscar al residente
        $residente = Residente::findOrFail($id);

        // Obtener y sanear el nombre del residente
        $nombreResidente = $request->input('Nombre_Residente');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreResidente); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del residente
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_residentes/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $residente->Foto_Residente = 'fotos_residentes/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Residente_File')) {
            $image = $request->file('Foto_Residente_File');

            // Generar un nombre de archivo basado en el nombre del residente
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_residentes', $imageName, 'public');

            // Actualizar la ruta de la imagen en el modelo
            $residente->Foto_Residente = $path;
        }

        // Actualizar los demás campos del residente
        $residente->Nombre_Residente = $nombreResidente;
        $residente->Tel_Cel_Residente = $request->input('Tel_Cel_Residente');
        $residente->ID_Apartamento = $request->input('ID_Apartamento');

        // Guardar los cambios
        $residente->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('residentes.index')
            ->with('mensaje', 'Residente actualizado con éxito')
            ->with('icon', 'success');
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

    public function updateStatus($id)
    {
        try {
            $residente =  Residente::findOrFail($id);
            $residente->status = 'inactive';
            $residente->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function activateStatus($id)
    {
        try {
            $residente = Residente::findOrFail($id);
            $residente->status = 'active';
            $residente->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
