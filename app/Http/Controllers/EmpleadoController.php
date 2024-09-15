<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Empleado::where('status', 'active');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_PersonalL', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_PersonalL', 'like', '%' . $request->search . '%');
            });
        }

        $empleados = $query->paginate(10);

        return view('empleados.index', compact('empleados'));

    }

    public function inactive(Request $request)
    {
        $query = Empleado::where('status', 'inactive');

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('ID_PersonalL', 'like', '%' . $request->search . '%')
                  ->orWhere('Nombre_PersonalL', 'like', '%' . $request->search . '%');
            });
        }

        $empleados = $query->paginate(10);

        return view('empleados.inactive', compact('empleados'));
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

        $empleadosIds = Empleado::pluck('ID_PersonalL')->toArray(); // Obtener los IDs de visitantes
        return view('empleados.create', compact('empleadosIds'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los campos del formulario
        $request->validate([
            'ID_PersonalL' => 'required|integer',
            'Foto_PersonalL_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen base64
            'Nombre_PersonalL' => 'required|string|max:255',
            'Edad_PersonalL' => 'nullable|integer',
            'Cargo_PersonalL' => 'nullable|string|max:255',
            'Direccion_PersonalL' => 'nullable|string|max:255',
            'Tel_Cel_PersonalL' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
            'ID_UNIDAD' => 'nullable|integer',
        ]);

        // Obtener y sanear el nombre del empleado
        $nombreEmpleado = $request->input('Nombre_PersonalL');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreEmpleado); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo único basado en el nombre del empleado
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_empleados/' . $imageName, $image);

            // Establecer la ruta de la imagen en la variable $path
            $path = 'fotos_empleados/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_PersonalL_File')) {
            $image = $request->file('Foto_PersonalL_File');

            // Generar un nombre de archivo único basado en el nombre del empleado
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_empleados', $imageName, 'public');
        }

        // Crear el nuevo empleado
        $empleado = new Empleado([
            'ID_PersonalL' => $request->get('ID_PersonalL', uniqid()), // Proporciona un valor único si no se proporciona
            'Foto_PersonalL' => $path ?? null,
            'Nombre_PersonalL' => $nombreEmpleado,
            'Edad_PersonalL' => $request->get('Edad_PersonalL'),
            'Cargo_PersonalL' => $request->get('Cargo_PersonalL'),
            'Direccion_PersonalL' => $request->get('Direccion_PersonalL'),
            'Tel_Cel_PersonalL' => $request->get('Tel_Cel_PersonalL'),
            'Tiempo_trabajo' => $request->get('Tiempo_trabajo'),
            'Fecha_Registro' => $request->get('Fecha_Registro'),
            'ID_UNIDAD' => $request->get('ID_UNIDAD')
        ]);

        // Guardar el empleado en la base de datos
        $empleado->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('empleados.index')
            ->with('mensaje', 'Empleado creado con éxito')
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
        $empleado = Empleado::findOrFail($id);
        return view('empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los campos del formulario
        $request->validate([
            'Foto_PersonalL_File' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen subida
            'imageData' => 'nullable|string', // Validación para la imagen base64
            'Nombre_PersonalL' => 'required|string|max:255',
            'Edad_PersonalL' => 'nullable|integer',
            'Cargo_PersonalL' => 'nullable|string|max:255',
            'Direccion_PersonalL' => 'nullable|string|max:255',
            'Tel_Cel_PersonalL' => 'nullable|string|max:255',
            'Tiempo_trabajo' => 'nullable|string|max:255',
            'Fecha_Registro' => 'nullable|date',
        ]);

        // Buscar el empleado por su ID
        $empleado = Empleado::findOrFail($id);

        // Obtener y sanear el nombre del empleado
        $nombreEmpleado = $request->input('Nombre_PersonalL');
        $nombreLimpio = preg_replace('/[^a-zA-Z0-9_-]/', '_', $nombreEmpleado); // Reemplaza espacios y caracteres especiales por "_"

        // Procesar la imagen base64 (si se captura desde la cámara)
        if ($request->filled('imageData')) {
            $imageData = $request->input('imageData');
            $imageData = str_replace('data:image/png;base64,', '', $imageData);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            // Generar un nombre de archivo único basado en el nombre del empleado
            $imageName = $nombreLimpio . '_' . uniqid() . '.png';

            // Guardar la imagen en el almacenamiento público
            Storage::disk('public')->put('fotos_empleados/' . $imageName, $image);

            // Actualizar la ruta de la imagen en el modelo
            $empleado->Foto_PersonalL = 'fotos_empleados/' . $imageName;
        }

        // Procesar la imagen cargada manualmente (si se selecciona un archivo)
        if ($request->hasFile('Foto_PersonalL_File')) {
            $image = $request->file('Foto_PersonalL_File');

            // Generar un nombre de archivo único basado en el nombre del empleado
            $imageName = $nombreLimpio . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el almacenamiento público
            $path = $image->storeAs('fotos_empleados', $imageName, 'public');

            // Actualizar la ruta de la imagen en el modelo
            $empleado->Foto_PersonalL = $path;
        }

        // Actualizar los demás campos del empleado
        $empleado->Nombre_PersonalL = $nombreEmpleado;
        $empleado->Edad_PersonalL = $request->input('Edad_PersonalL');
        $empleado->Cargo_PersonalL = $request->input('Cargo_PersonalL');
        $empleado->Direccion_PersonalL = $request->input('Direccion_PersonalL');
        $empleado->Tel_Cel_PersonalL = $request->input('Tel_Cel_PersonalL');
        $empleado->Tiempo_trabajo = $request->input('Tiempo_trabajo');
        $empleado->Fecha_Registro = $request->input('Fecha_Registro', now());

        // Guardar los cambios en la base de datos
        $empleado->save();

        // Redirigir con un mensaje de éxito
        return redirect()->route('empleados.index')
            ->with('mensaje', 'Empleado actualizado con éxito')
            ->with('icon', 'success');
    }


    public function updateStatus($id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->status = 'inactive';
            $empleado->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function activateStatus($id)
    {
        try {
            $empleado = Empleado::findOrFail($id);
            $empleado->status = 'active'; // Cambia el status según tu lógica
            $empleado->save();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Manejo de errores
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
