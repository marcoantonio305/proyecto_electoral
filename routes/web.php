<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formulario', [App\Http\Controllers\MesaController::class, 'formulario']);
Route::post('/formulario/enviar', [App\Http\Controllers\MesaController::class, 'enviarDocumento']);
