<?php

namespace App\Http\Controllers;

use App\Models\Administrador;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $administradors = Administrador::where('Estado', 'activo')->paginate(10);
        return view('administradors.index', compact('administradors'));
    }

    public function inactive()
    {
        $administradors = Administrador::where('Estado', 'inactivo')->paginate(10);
        return view('administradors.inactive', compact('administradors'));
    }

    public function pdf(){
        $administradors=Administrador::all();
        $pdf = Pdf::loadView('administradors.pdf', compact('administradors'));
        return $pdf->stream();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $administradorsIds = Administrador::pluck('ID_Administrador')->toArray(); // Obtener los IDs de apartamentos
        return view('administradors.create', compact('administradorsIds'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'ID_Administrador' => 'required|integer',
            'Foto_Administrador' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Permitir imagen como archivo
            'imageData' => 'nullable|string', // Validar el campo para imagen base64
            'Nombre_Administrador' => 'required|string|max:255',
            'Edad_Administrador' => 'nullable|integer',
            'Cargo_Administrador' => 'nullable|string|max:255',
            'Direccion_Administrador' => 'nullable|string|max:255',
            'Tel_Cel_Administrador' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer',
        ]);

        // Procesar la imagen de la cámara (base64) si está presente
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre único para la imagen
            $imageName = uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_administrador/' . $imageName, $image);

            $path = 'fotos_administrador/' . $imageName;
        }

        // Procesar la imagen cargada desde un archivo
        if ($request->hasFile('Foto_Administrador')) {
            $image = $request->file('Foto_Administrador');
            $path = $image->store('fotos_administrador', 'public');
        }

        // Guardar la información del administrador en la base de datos
        $administrador = new Administrador([
            'ID_Administrador' => $request->get('ID_Administrador'),
            'Foto_Administrador' => $path ?? null, // Guardar la ruta de la imagen si existe
            'Nombre_Administrador' => $request->get('Nombre_Administrador'),
            'Edad_Administrador' => $request->get('Edad_Administrador'),
            'Cargo_Administrador' => $request->get('Cargo_Administrador'),
            'Direccion_Administrador' => $request->get('Direccion_Administrador'),
            'Tel_Cel_Administrador' => $request->get('Tel_Cel_Administrador'),
            'Tiempo_trabajo' => $request->get('Tiempo_trabajo'),
            'Fecha_Registro' => $request->get('Fecha_Registro'),
            'ID_UNIDAD' => $request->get('ID_UNIDAD'),
        ]);

        $administrador->save();

        return redirect()->route('administradors.index')
            ->with('mensaje', 'Administrador creado con éxito')
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
        $administrador = Administrador::findOrFail($id);
        return view('administradors.edit', compact('administrador'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los campos del formulario
        $request->validate([
            'Foto_Administrador_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen capturada desde la cámara (base64)
            'Nombre_Administrador' => 'required|string|max:255',
            'Edad_Administrador' => 'nullable|integer',
            'Cargo_Administrador' => 'nullable|string|max:255',
            'Direccion_Administrador' => 'nullable|string|max:255',
            'Tel_Cel_Administrador' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date'
        ]);

        // Buscar al administrador
        $administrador = Administrador::findOrFail($id);

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre único para la imagen
            $imageName = uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_administrador/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $administrador->Foto_Administrador = 'fotos_administrador/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_Administrador_File')) {
            $image = $request->file('Foto_Administrador_File');
            $path = $image->store('fotos_administrador', 'public');
            $administrador->Foto_Administrador = $path;
        }

        // Actualizar los demás campos del administrador
        $administrador->Nombre_Administrador = $request->input('Nombre_Administrador');
        $administrador->Edad_Administrador = $request->input('Edad_Administrador');
        $administrador->Cargo_Administrador = $request->input('Cargo_Administrador');
        $administrador->Direccion_Administrador = $request->input('Direccion_Administrador');
        $administrador->Tel_Cel_Administrador = $request->input('Tel_Cel_Administrador');
        $administrador->Tiempo_trabajo = $request->input('Tiempo_trabajo');
        $administrador->Fecha_Registro = $request->input('Fecha_Registro');

        // Guardar los cambios
        $administrador->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('administradors.index')
            ->with('mensaje', 'Administrador actualizado con éxito')
            ->with('icon', 'success');
    }


    public function updateStatus($id)
    {
        try {
            $administrador =  Administrador::findOrFail($id);
            $administrador->Estado = 'inactivo';
            $administrador->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function activateStatus($id)
    {
        try {
            $administrador = Administrador::findOrFail($id);
            $administrador->Estado= 'activo';
            $administrador->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
