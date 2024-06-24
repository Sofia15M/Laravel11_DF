<?php

use App\Http\Controllers\ResidenteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
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
    Route::resource('residentes', ResidenteController::class);
    Route::delete('/residentes/{id}', 'ResidenteController@destroy')->name('residentes.destroy');
});


