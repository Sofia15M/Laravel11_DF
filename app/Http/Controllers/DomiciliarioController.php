<?php

namespace App\Http\Controllers;

use App\Models\Apartamento;
use App\Models\Domiciliario;
use App\Models\Residente;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class DomiciliarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Domiciliario::where('Estado', 'activo');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Domiciliario', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Domiciliario', 'like', '%' . $request->search . '%');
            });
        }

        $domiciliarios = $query->paginate(10);

        return view('domiciliarios.index', compact('domiciliarios'));

    }

    public function inactive(Request $request)
    {
        $query = Domiciliario::where('Estado', 'inactivo');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_Domiciliario', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_Domiciliario', 'like', '%' . $request->search . '%');
            });
        }

        $domiciliarios = $query->paginate(10);

        return view('domiciliarios.inactive', compact('domiciliarios'));
    }

    public function pdf(){
        $domiciliarios=Domiciliario::all();
        $pdf = Pdf::loadView('domiciliarios.pdf', compact('domiciliarios'));
        return $pdf->stream();
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $domiciliariosIds = Domiciliario::pluck('ID_Domiciliario')->toArray(); // Obtener los IDs de apartamentos
        $apartamentos = Apartamento::all(); // Obtener la lista de apartamentos
        $residentes = Residente::all();
        // Pasar ambas variables a la vista
        return view('domiciliarios.create', compact('domiciliariosIds', 'apartamentos', 'residentes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'Id_Domiciliario' => 'required|integer',
            'Foto_Domiciliario' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Permitir imagen como archivo, puede ser nulo
            'imageData' => 'nullable|string', // Validar el campo para imagen base64
            'Nombre_Recidente' => 'required|string|max:255',
            'Nombre_Domiciliario' => 'required|string|max:255',
            'id_Apartamento' => 'required|string|max:10',
            'estado' => 'nullable|string|max:255', // Validar el estado si se proporciona
        ]);

        // Obtener y sanear el nombre del domiciliario
        $nombreDomiciliario = $request->get('Nombre_Domiciliario');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreDomiciliario); // Reemplaza espacios y caracteres especiales por "_"

        // Inicializar la variable para la ruta de la imagen
        $path = null;

        // Procesar la imagen en base64 si está presente
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo basado en el nombre del domiciliario
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            $path = 'fotos_domiciliario/' . $imageName;
            Storage::disk('public')->put($path, $image);
        }

        // Procesar la imagen cargada desde un archivo si está presente
        if ($request->hasFile('Foto_Domiciliario')) {
            $image = $request->file('Foto_Domiciliario');

            // Generar un nombre de archivo basado en el nombre del domiciliario
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_domiciliario', $imageName, 'public');
        }

        // Crear el domiciliario y asignar los datos
        $domiciliario = new Domiciliario([
            'Id_Domiciliario' => $request->get('Id_Domiciliario'),
            'Nombre_Domiciliario' => $request->get('Nombre_Domiciliario'),
            'Foto_Domiciliario' => $path,
            'Nombre_Recidente' => $request->get('Nombre_Recidente'),
            'id_Apartamento' => $request->get('id_Apartamento'),
            'estado' => $request->get('estado', 'activo') // Establecer un estado por defecto si no se proporciona
        ]);

        // Guardar el domiciliario en la base de datos
        $domiciliario->save();

        // Redirigir a la lista de domiciliarios con un mensaje de éxito
        return redirect()->route('domiciliarios.index')
            ->with('mensaje', 'Domiciliario creado con éxito')
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
        $domiciliario = Domiciliario::findOrFail($id);
        $apartamentos = Apartamento::all();
        $residentes = Residente::all();
        return view('domiciliarios.edit', compact('domiciliario', 'apartamentos', 'residentes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los campos del formulario
        $request->validate([
            'Nombre_Domiciliario' => 'required|string|max:255',
            'Nombre_Recidente' => 'required|string|max:255',
            'id_Apartamento' => 'required|string|max:10',
            'imageData' => 'nullable|string', // Validación para la imagen capturada desde la cámara (base64)
        ]);

        // Buscar el domiciliario
        $domiciliario = Domiciliario::findOrFail($id);

        // Obtener y sanear el nombre del domiciliario
        $nombreDomiciliario = $request->input('Nombre_Domiciliario');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreDomiciliario); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Verificar que la imagen se decodificó correctamente
            if ($image === false) {
                return redirect()->route('domiciliarios.index')
                    ->with('mensaje', 'Error al procesar la imagen base64.')
                    ->with('icon', 'error');
            }

            // Generar un nombre de archivo basado en el nombre del domiciliario
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_domiciliario/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $domiciliario->Foto_Domiciliario = 'fotos_domiciliario/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Domiciliario_File')) {
            $image = $request->file('Foto_Domiciliario_File');

            // Generar un nombre de archivo basado en el nombre del domiciliario
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_domiciliario', $imageName, 'public');

            // Actualizar la ruta de la imagen en el modelo
            $domiciliario->Foto_Domiciliario = $path;
        }

        // Actualizar los demás campos del domiciliario
        $domiciliario->Nombre_Domiciliario = $request->input('Nombre_Domiciliario');
        $domiciliario->Nombre_Recidente = $request->input('Nombre_Recidente');
        $domiciliario->id_Apartamento = $request->input('id_Apartamento');

        // Guardar los cambios
        $domiciliario->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('domiciliarios.index')
            ->with('mensaje', 'Domiciliario actualizado con éxito')
            ->with('icon', 'success');
    }




    public function updateStatus($id)
    {
        try {
            $domiciliario =  Domiciliario::findOrFail($id);
            $domiciliario->Estado = 'inactivo';
            $domiciliario->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function activateStatus($id)
    {
        try {
            $domiciliario = Domiciliario::findOrFail($id);
            $domiciliario->Estado= 'activo';
            $domiciliario->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

}
