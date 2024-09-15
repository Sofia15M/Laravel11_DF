<?php

namespace App\Http\Controllers;

use App\Models\Vigilante;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class VigilanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Vigilante::where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Vigilante', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Vigilante', 'like', '%' . $request->search . '%');
            });
        }

        $vigilantes = $query->paginate(10);

        return view('vigilantes.index', compact('vigilantes'));

    }

    public function inactive(Request $request)
    {
        $query = Vigilante::where('status', 'inactive');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Vigilante', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Vigilante', 'like', '%' . $request->search . '%');
            });
        }

        $vigilantes = $query->paginate(10);

        return view('vigilantes.inactive', compact('vigilantes'));
    }

    public function pdf(){
        $vigilantes=Vigilante::all();
        $pdf = Pdf::loadView('vigilantes.pdf', compact('vigilantes'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vigilantesIds = Vigilante::pluck('ID_Vigilante')->toArray(); // Obtener los IDs de apartamentos
        return view('vigilantes.create', compact('vigilantesIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'ID_Vigilante' => 'required|integer',
            'Foto_Vigilante_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen cargada
            'imageData' => 'nullable|string', // Validación para la imagen capturada en base64
            'Nombre_Vigilante' => 'required|string|max:255',
            'Edad_Vigilante' => 'nullable|integer',
            'Cargo_Vigilante' => 'nullable|string|max:255',
            'Direccion_Vigilante' => 'nullable|string|max:255',
            'Tel_Cel_Vigilante' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer',
        ]);

        // Obtener y sanear el nombre del vigilante
        $nombreVigilante = $request->get('Nombre_Vigilante');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreVigilante); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del vigilante
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_vigilantes/' . $imageName, $image);

            // Asignar la ruta de la imagen
            $path = 'fotos_vigilantes/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Vigilante_File')) {
            $image = $request->file('Foto_Vigilante_File');

            // Generar un nombre de archivo único basado en el nombre del vigilante
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_vigilantes', $imageName, 'public');
        }

        // Crear el vigilante y asignar los datos
        $vigilante = new Vigilante([
            'ID_Vigilante' => $request->get('ID_Vigilante', uniqid()), // Proporciona un valor único si no se proporciona
            'Foto_Vigilante' => $path ?? null, // Guardar la ruta de la imagen si existe
            'Nombre_Vigilante' => $nombreVigilante,
            'Edad_Vigilante' => $request->get('Edad_Vigilante'),
            'Cargo_Vigilante' => $request->get('Cargo_Vigilante'),
            'Direccion_Vigilante' => $request->get('Direccion_Vigilante'),
            'Tel_Cel_Vigilante' => $request->get('Tel_Cel_Vigilante'),
            'Tiempo_trabajo' => $request->get('Tiempo_trabajo'),
            'Fecha_Registro' => $request->get('Fecha_Registro'),
            'ID_UNIDAD' => $request->get('ID_UNIDAD'),
        ]);

        // Guardar el vigilante en la base de datos
        $vigilante->save();

        // Redirigir a la lista de vigilantes con un mensaje de éxito
        return redirect()->route('vigilantes.index')
            ->with('mensaje', 'Vigilante creado con éxito')
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
        $vigilante = Vigilante::findOrFail($id);
        return view('vigilantes.edit', compact('vigilante'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los campos del formulario
        $request->validate([
            'Foto_Vigilante_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen base64
            'Nombre_Vigilante' => 'required|string|max:255',
            'Edad_Vigilante' => 'nullable|integer',
            'Cargo_Vigilante' => 'nullable|string|max:255',
            'Direccion_Vigilante' => 'nullable|string|max:255',
            'Tel_Cel_Vigilante' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
        ]);

        // Buscar al vigilante
        $vigilante = Vigilante::findOrFail($id);

        // Obtener y sanear el nombre del vigilante
        $nombreVigilante = $request->input('Nombre_Vigilante');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreVigilante); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo único basado en el nombre del vigilante
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_vigilantes/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $vigilante->Foto_Vigilante = 'fotos_vigilantes/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Vigilante_File')) {
            $image = $request->file('Foto_Vigilante_File');

            // Generar un nombre de archivo único basado en el nombre del vigilante
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_vigilantes', $imageName, 'public');

            // Actualizar la ruta de la imagen en el modelo
            $vigilante->Foto_Vigilante = $path;
        }

        // Actualizar los demás campos del vigilante
        $vigilante->Nombre_Vigilante = $nombreVigilante;
        $vigilante->Edad_Vigilante = $request->input('Edad_Vigilante');
        $vigilante->Cargo_Vigilante = $request->input('Cargo_Vigilante');
        $vigilante->Direccion_Vigilante = $request->input('Direccion_Vigilante');
        $vigilante->Tel_Cel_Vigilante = $request->input('Tel_Cel_Vigilante');
        $vigilante->Tiempo_trabajo = $request->input('Tiempo_trabajo');

        // Guardar los cambios en la base de datos
        $vigilante->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('vigilantes.index')
            ->with('mensaje', 'Vigilante actualizado con éxito')
            ->with('icon', 'success');
    }


    public function updateStatus($id)
    {
        try {
            $vigilante = Vigilante::findOrFail($id);
            $vigilante->status = 'inactive';
            $vigilante->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function activateStatus($id)
    {
        try {
            $vigilante = Vigilante::findOrFail($id);
            $vigilante->status = 'active'; // Cambia el status según tu lógica
            $vigilante->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
