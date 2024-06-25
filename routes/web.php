<?php

use App\Http\Controllers\AdministradorController;
use App\Http\Controllers\ApartamentoController;
use App\Http\Controllers\DomiciliarioController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\PropietarioController;
use App\Http\Controllers\ResidenteController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\VigilanteController;
use App\Http\Controllers\VisitanteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    //ruta para el controller
    Route::resource('unidads', UnidadController::class);
    Route::resource('residentes', ResidenteController::class);
    Route::resource('apartamentos', ApartamentoController::class);
    Route::resource('propietarios', PropietarioController::class);
    Route::resource('administradors', AdministradorController::class);
    Route::resource('vigilantes', VigilanteController::class);
    Route::resource('empleados', EmpleadoController::class);
    Route::resource('visitantes', VisitanteController::class);
    Route::resource('domiciliarios', DomiciliarioController::class);
    Route::get('registros', function () {
        return view('auth.register');
    })->name('auth.register');

    //Route::delete('/residentes/{id}', 'ResidenteController@destroy')->name('residentes.destroy');
});


