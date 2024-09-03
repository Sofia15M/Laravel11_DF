<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\BienvenidaController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\DomiciliarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\ResidenteController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\VisitanteController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

// Ruta para la página de inicio de sesión
Route::get('/', function () {
    return view('auth.login');
});

// Agrupamos las rutas que requieren autenticación y verificación
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('registros', function () {
        return view('auth.register');
    })->name('auth.register');

    Route::post('register', [RegisteredUserController::class, 'store'])
    ->name('register');

    // Ruta del dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('terminos&condiciones', function(){
        return view('terminos.pdf');
    });

    // Rutas para PDFs
    Route::get('apartamentos/pdf', [ApartamentoController::class, 'pdf'])->name('apartamentos.pdf');
    Route::get('residentes/pdf', [ResidenteController::class, 'pdf'])->name('residentes.pdf');
    Route::get('propietarios/pdf', [PropietarioController::class, 'pdf'])->name('propietarios.pdf');
    Route::get('administradors/pdf', [AdministradorController::class, 'pdf'])->name('administradors.pdf');
    Route::get('vigilantes/pdf', [VigilanteController::class, 'pdf'])->name('vigilantes.pdf');
    Route::get('empleados/pdf', [EmpleadoController::class, 'pdf'])->name('empleados.pdf');
    Route::get('visitantes/pdf', [VisitanteController::class, 'pdf'])->name('visitantes.pdf');
    Route::get('domiciliarios/pdf', [DomiciliarioController::class, 'pdf'])->name('domiciliarios.pdf');

    // Ruta desactivados
    Route::get('/apartamentos/desactivados', [ApartamentoController::class, 'inactive'])->name('apartamentos.inactive');
    Route::get('/residentes/desactivados', [ResidenteController::class, 'inactive'])->name('residentes.inactive');
    Route::get('/propietarios/desactivados', [PropietarioController::class, 'inactive'])->name('propietarios.inactive');
    Route::get('/administradors/desactivados', [AdministradorController::class, 'inactive'])->name('administradors.inactive');
    Route::get('/vigilantes/desactivados', [VigilanteController::class, 'inactive'])->name('vigilantes.inactive');
    Route::get('/empleados/desactivados', [EmpleadoController::class, 'inactive'])->name('empleados.inactive');
    Route::get('/visitantes/desactivados', [VisitanteController::class, 'inactive'])->name('visitantes.inactive');
    Route::get('/domiciliarios/desactivados', [DomiciliarioController::class, 'inactive'])->name('domiciliarios.inactive');

    // Rutas resource para los controladores
    Route::resource('unidads', UnidadController::class);
    Route::resource('residentes', ResidenteController::class);
    Route::resource('apartamentos', ApartamentoController::class);
    Route::resource('propietarios', PropietarioController::class);
    Route::resource('administradors', AdministradorController::class);
    Route::resource('vigilantes', VigilanteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('visitantes', VisitanteController::class);
    Route::resource('domiciliarios', DomiciliarioController::class);

    // Ruta personas reconocidas
    Route::get('/personas', [PersonaController::class, 'index'])->name('personas.index');
    
    // Ruta para el registro de usuarios (probablemente sea innecesaria si se gestiona por Jetstream)
    //Route::get('registros', function () {
    //   return view('auth.register');
    //})->name('auth.register');
});
