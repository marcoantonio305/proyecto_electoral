<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/formulario', [App\Http\Controllers\Controller::class, 'formulario']);
