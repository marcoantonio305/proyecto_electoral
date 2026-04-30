<?php

namespace App\Http\Controllers;

use App\Models\ComposicionMesaImport;
use App\Models\ComposicionMesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class MesaController extends Controller
{
    public function formulario(Request $request)
{
    $titulo = Storage::disk('local')->exists('titulo.txt')
        ? Storage::disk('local')->get('titulo.txt')
        : 'Buscador de mesas';

    if (Auth::check()) {
        return view('editar', compact('titulo'));
    }

    return view('formulario', compact('titulo'));
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
            Excel::import(new \App\Models\ComposicionMesaImport, $request->file('archivo_excel'));
        });

        return response()->json(['success' => true, 'message' => 'Importado con éxito']);

    } catch (\Exception $e) {
        return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
    }
}

    public function guardarTitulo(Request $request) {
    $request->validate(['titulo' => 'required|string|max:255']);

    Storage::disk('local')->put('titulo.txt', $request->titulo);

    return response()->json(['success' => true]);
}

public function editar(Request $request)
    {
        $mesas = ComposicionMesa::all();
        $titulo = Storage::exists('titulo.txt') ? Storage::get('titulo.txt') : 'Buscador de mesas';
        return view('edit', compact('mesas', 'titulo'));
    }
}
