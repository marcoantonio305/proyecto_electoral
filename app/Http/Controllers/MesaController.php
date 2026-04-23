<?php

namespace App\Http\Controllers;

use App\Imports\ComposicionMesaImport;
use App\Models\ComposicionMesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class MesaController extends Controller
{
    public function formulario(Request $request)
    {
        $mesas = ComposicionMesa::all();

        $persona = ComposicionMesa::first();

        return view('formulario', compact('mesas', 'persona'));
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


}
