<?php

namespace App\Http\Controllers;

use App\Models\ComposicionMesa; // Importación correcta
use Illuminate\Http\Request;

class MesaController extends Controller // Clase normal, NO abstracta
{
    public function formulario()
    {
        $mesas = ComposicionMesa::all();

        return view('formulario', compact('mesas'));
    }

    public function enviarDocumento(Request $request)
    {
        $persona = ComposicionMesa::where('Documento', $request->input('documento'))->first();

    return view('formulario', [
        'persona' => $persona
    ]);
    }
}
