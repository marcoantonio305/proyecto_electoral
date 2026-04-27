<?php

namespace App\Http\Controllers;

use App\Imports\ComposicionMesaImport;
use App\Models\ComposicionMesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class MesaController extends Controller
{
    public function formulario(Request $request)
    {
        $mesas = ComposicionMesa::all();

        $titulo = Storage::exists('titulo.txt') ? Storage::get('titulo.txt') : 'Buscador de mesas';

        return view('formulario', compact('mesas', 'titulo'));
    }

    public function enviarDocumento(Request $request)
    {
        $persona = ComposicionMesa::where('documento', $request->input('documento'))->first();

    if ($persona) {
        return response()->json([
            'success' => true,
            'datos'   => $persona
        ]);
    }

    return response()->json(['success' => false, 'message' => 'No encontrado'], 404);
    }

    public function importarExcel(Request $request)
{
    try {
        if (!$request->hasFile('archivo_excel')) {
            return response()->json(['success' => false, 'message' => 'No se seleccionó ningún archivo'], 400);
        }
        DB::transaction(function () use ($request) {
            ComposicionMesa::truncate();
            Excel::import(new ComposicionMesaImport, $request->file('archivo_excel'));
        });

        return response()->json(['success' => true, 'message' => 'Importado con éxito']);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

    public function guardarTitulo(Request $request) {
    $request->validate(['titulo' => 'required|string|max:255']);

    // Guardamos en el archivo persistente
    Storage::disk('local')->put('titulo.txt', $request->titulo);

    return response()->json(['success' => true]);
}

}
