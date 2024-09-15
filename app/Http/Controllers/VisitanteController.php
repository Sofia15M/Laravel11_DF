<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\Visitante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class VisitanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Visitante::where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Visitante', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Visitante', 'like', '%' . $request->search . '%');
            });
        }

        $visitantes = $query->paginate(10);

        return view('visitantes.index', compact('visitantes'));

    }

    public function inactive(Request $request)
    {
        $query = Visitante::where('status', 'inactive');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Visitante', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Visitante', 'like', '%' . $request->search . '%');
            });
        }

        $visitantes = $query->paginate(10);

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
        // Validar los campos del formulario
        $request->validate([
            'ID_Visitante' => 'required|integer|unique:visitantes,ID_Visitante',
            'Foto_Visitante' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Permitir imagen como archivo
            'imageData' => 'nullable|string', // Validar el campo para imagen base64
            'Nombre_Visitante' => 'required|string|max:255',
            'Tel_Cel_Visitante' => 'required|string|max:255',
            'ID_Apartamento' => 'required|integer|exists:apartamentos,ID_Apartamento',
            'Hora_Ingreso' => 'required|date',
            'Hora_Salida' => 'nullable|date',
        ]);

        // Obtener y sanear el nombre del visitante
        $nombreVisitante = $request->get('Nombre_Visitante');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreVisitante); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen de la cámara (base64) si está presente
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del visitante
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_visitantes/' . $imageName, $image);

            $path = 'fotos_visitantes/' . $imageName;
        }

        // Procesar la imagen cargada desde un archivo
        if ($request->hasFile('Foto_Visitante')) {
            $image = $request->file('Foto_Visitante');

            // Generar un nombre de archivo basado en el nombre del visitante
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_visitantes', $imageName, 'public');
        }

        // Crear el visitante y asignar los datos
        $visitante = new Visitante([
            'ID_Visitante' => $request->get('ID_Visitante'),
            'Foto_Visitante' => $path ?? null, // Guardar la ruta de la imagen si existe
            'Nombre_Visitante' => $nombreVisitante,
            'Tel_Cel_Visitante' => $request->get('Tel_Cel_Visitante'),
            'ID_Apartamento' => $request->get('ID_Apartamento'), // Asegúrate de guardar este campo
            'Hora_Ingreso' => $request->get('Hora_Ingreso'),
            'Hora_Salida' => $request->get('Hora_Salida'),
        ]);

        // Guardar el visitante en la base de datos
        $visitante->save();

        // Redirigir a la lista de visitantes con un mensaje de éxito
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
        $apartamentos = Apartamento::all();
        return view('visitantes.edit', compact('visitante', 'apartamentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los campos del formulario
        $request->validate([
            'Foto_Visitante_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen capturada desde la cámara (base64)
            'Nombre_Visitante' => 'required|string|max:255',
            'Tel_Cel_Visitante' => 'required|string|max:255',
        ]);

        // Buscar al visitante
        $visitante = Visitante::findOrFail($id);

        // Obtener y sanear el nombre del visitante
        $nombreVisitante = $request->input('Nombre_Visitante');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreVisitante); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del visitante
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_visitante/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $visitante->Foto_Visitante = 'fotos_visitante/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Visitante_File')) {
            $image = $request->file('Foto_Visitante_File');

            // Generar un nombre de archivo basado en el nombre del visitante
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_visitante', $imageName, 'public');

            // Actualizar la ruta de la imagen en el modelo
            $visitante->Foto_Visitante = $path;
        }

        // Actualizar los demás campos del visitante
        $visitante->Nombre_Visitante = $request->input('Nombre_Visitante');
        $visitante->Tel_Cel_Visitante = $request->input('Tel_Cel_Visitante');

        // Guardar los cambios
        $visitante->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('visitantes.index')
            ->with('mensaje', 'Visitante actualizado con éxito')
            ->with('icon', 'success');
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
