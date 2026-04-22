<?php

use App\Http\Controllers\MesaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MesaController::class, 'formulario']);

Route::get('/formulario', [MesaController::class, 'formulario']);
Route::post('/formulario/enviar', [MesaController::class, 'enviarDocumento']);
Route::post('/formulario/importar', [MesaController::class, 'importarExcel']);
