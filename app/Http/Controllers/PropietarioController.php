<?php

namespace App\Http\Controllers;

use App\Models\Propietario;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class PropietarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Iniciar la consulta para propietarios activos
        $query = Propietario::where('status', 'active');

        // Comprobar si hay un término de búsqueda
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Propietario', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Propietario', 'like', '%' . $request->search . '%');
            });
        }

        // Paginar los resultados
        $propietarios = $query->paginate(10);

        // Devolver la vista con los propietarios filtrados
        return view('propietarios.index', compact('propietarios'));
    }

    public function inactive(Request $request)
    {
        // Iniciar la consulta para propietarios inactivos
        $query = Propietario::where('status', 'inactive');

        // Comprobar si hay un término de búsqueda
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Propietario', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Propietario', 'like', '%' . $request->search . '%');
            });
        }

        // Paginar los resultados
        $propietarios = $query->paginate(10);

        // Devolver la vista con los propietarios inactivos
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
        $propietariosIds = Propietario::pluck('ID_Propietario')->toArray(); // Obtener los IDs de apartamentos
        return view('propietarios.create', compact('propietariosIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'ID_Propietario' => 'required|integer',
            'Foto_Propietario' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Permitir imagen como archivo
            'imageData' => 'nullable|string', // Validar el campo para imagen base64
            'Nombre_Propietario' => 'required|string|max:255',
            'Tel_Cel_Propietario' => 'required|string|max:255'
        ]);

        // Obtener y sanear el nombre del propietario
        $nombrePropietario = $request->get('Nombre_Propietario');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombrePropietario); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen de la cámara (base64) si está presente
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del propietario
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_propietarios/' . $imageName, $image);

            $path = 'fotos_propietarios/' . $imageName;
        }

        // Procesar la imagen cargada desde un archivo
        if ($request->hasFile('Foto_Propietario')) {
            $image = $request->file('Foto_Propietario');

            // Generar un nombre de archivo basado en el nombre del propietario
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_propietarios', $imageName, 'public');
        }

        // Crear el propietario y asignar los datos
        $propietario = new Propietario([
            'ID_Propietario' => $request->get('ID_Propietario'),
            'Nombre_Propietario' => $nombrePropietario,
            'Tel_Cel_Propietario' => $request->get('Tel_Cel_Propietario'),
            'Foto_Propietario' => $path ?? null, // Guardar la ruta de la imagen si existe
        ]);

        // Guardar el propietario en la base de datos
        $propietario->save();

        // Redirigir a la lista de propietarios con un mensaje de éxito
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
        // Validación de los campos del formulario
        $request->validate([
            'Nombre_Propietario' => 'required|string|max:255',
            'Tel_Cel_Propietario' => 'required|string|max:255',
            'Foto_Propietario_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen capturada desde la cámara (base64)
        ]);

        // Buscar al propietario
        $propietario = Propietario::findOrFail($id);

        // Obtener y sanear el nombre del propietario
        $nombrePropietario = $request->input('Nombre_Propietario');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombrePropietario); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del propietario
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_propietarios/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $propietario->Foto_Propietario = 'fotos_propietarios/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Propietario_File')) {
            $image = $request->file('Foto_Propietario_File');

            // Generar un nombre de archivo basado en el nombre del propietario
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_propietarios', $imageName, 'public');

            // Actualizar la ruta de la imagen en el modelo
            $propietario->Foto_Propietario = $path;
        }

        // Actualizar los demás campos del propietario
        $propietario->Nombre_Propietario = $nombrePropietario;
        $propietario->Tel_Cel_Propietario = $request->input('Tel_Cel_Propietario');

        // Guardar los cambios
        $propietario->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('propietarios.index')
            ->with('mensaje', 'Propietario actualizado con éxito')
            ->with('icon', 'success');
    }


    public function updateStatus($id)
    {
        try {
            $propietario =  Propietario::findOrFail($id);
            $propietario->status = 'inactive';
            $propietario->save();

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
            $propietario = Propietario::findOrFail($id);
            $propietario->status = 'active';
            $propietario->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


}
