<?php

namespace App\Http\Controllers;

use App\Imports\ComposicionMesaImport;
use App\Models\ComposicionMesa;
use Illuminate\Http\Request;
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
        $request->validate([
            'archivo_excel' => 'required|mimes:xlsx,xls,csv'
        ]);

        Excel::import(new ComposicionMesaImport, $request->file('archivo_excel'));

        return response()->json(['success' => true]);
    }
}
