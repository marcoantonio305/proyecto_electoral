<?php
namespace App\Imports;

use App\Models\ComposicionMesa as ComposicionMesaModel; // Usamos un alias
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ComposicionMesaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Usamos el alias para que no choque con el nombre de esta clase
        return new ComposicionMesaModel([
            'codigo'            => $row['codigo'],
            'descripcion'       => $row['descripcion'],
            'dist'              => $row['dist'],
            'sec'               => $row['sec'],
            'mesa'              => $row['mesa'],
            'cargo_id'          => $row['cargo'],
            'cargo_nombre'      => $row['cargo_2'],
            'nombre'            => $row['nombre'],
            'apellido_1'        => $row['apellido_1'],
            'apellido_2'        => $row['apellido_2'],
            'orden'             => $row['orden'],
            'documento'         => $row['documento'],
            'direccion'         => $row['direccion'],
            'colegio_electoral' => $row['colegio_electoral'],
            'direccion_colegio' => $row['direccion_colegio_electoral'],
            'numero_elector'    => $row['numero_elector'],
        ]);
    }
}
