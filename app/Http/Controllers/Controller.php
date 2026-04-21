<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function formulario() {
        return view('formulario');
    }
}
