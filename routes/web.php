<?php

use App\Http\Controllers\MesaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MesaController::class, 'formulario'])->name('formulario');
Route::post('/formulario/enviar', [MesaController::class, 'enviarDocumento']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::post('/formulario/importar', [MesaController::class, 'importarExcel']);
    Route::post('/guardar-titulo', [MesaController::class, 'guardarTitulo']);

    Route::get('/editar', [MesaController::class, 'editar'])->name('editar');
});
