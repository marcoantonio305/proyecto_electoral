<?php
namespace App\Models;

use App\Models\ComposicionMesa as ComposicionMesaModel; // Usamos un alias
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ComposicionMesaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Usamos el alias para que no choque con el nombre de esta clase
        return new ComposicionMesaModel([
            'Código'            => $row['codigo'],
            'Descripción'       => $row['descripcion'],
            'Dist.'              => $row['dist'],
            'Sec.'               => $row['sec'],
            'Mesa'              => $row['mesa'],
            'Cargo'          => $row['cargo'],
            'Cargo'      => $row['cargo_2'],
            'Nombre'            => $row['nombre'],
            'Apellido 1'        => $row['apellido_1'],
            'Apellido 2'        => $row['apellido_2'],
            'Orden'             => $row['orden'],
            'Documento'         => $row['documento'],
            'Dirección'         => $row['direccion'],
            'Colegio Electoral' => $row['colegio_electoral'],
            'Dirección Colegio Electoral' => $row['direccion_colegio_electoral'],
            'Número Elector'    => $row['numero_elector'],
            'E. Colectiva'      => $row['e_colectiva'],
            'E. Singular'       => $row['e_singular'],
            'Núcleo'           => $row['nucleo'],
            'Dirección Padrón'  => $row['direccion_padron'],
            'E. Colectiva Padrón' => $row['e_colectiva_padron'],
            'E. Singular Padrón'  => $row['e_singular_padron'],
            'Núcleo Padrón'      => $row['nucleo_padron'],
            'Código Postal'      => $row['codigo_postal'],
        ]);
    }
}
