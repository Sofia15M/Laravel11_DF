<?php

use App\Http\Controllers\RecognitionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/recognize-person', [RecognitionController::class, 'recognize'])->name('recognize.person');
