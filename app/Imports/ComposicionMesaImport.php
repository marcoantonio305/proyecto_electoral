<?php

namespace App\Imports;

use App\Models\ComposicionMesa;
use Maatwebsite\Excel\Concerns\ToModel;

class ComposicionMesaImport implements ToModel
{
    public function model(array $row)
    {

        if ($row[0] === 'Código' || $row[0] === 'codigo') {
            return null;
        }

        return new ComposicionMesa([
            'Código'            => $row[0],
            'Descripción'       => $row[1],
            'Dist.'            => $row[2],
            'Sec.'             => $row[3],
            'Mesa'             => $row[4],
            'Cargo'           => $row[5]  ,
            'Cargo'           => $row[6],
            'Nombre'          => $row[7],
            'Apellido 1'      => $row[8],
            'Apellido 2'      => $row[9],
            'Orden'           => $row[10],
            'Documento'       => $row[11],
            'Dirección'      => $row[12],
            'E.Colectiva'    => $row[13],
            'E.Singular'     => $row[14],
            'Núcleo'        => $row[15],
            'Colegio Electoral'=> $row[16],
            'Dirección Colegio Electoral'=> $row[17],
            'Dirección Padrón'=> $row[18],
            'E. Colectiva Padrón'=> $row[19],
            'E. Singular Padrón'=> $row[20],
            'Núcleo Padrón'=> $row[21],
            'Código Postal'=> $row[22],
            'Número Elector'=> $row[23]
        ]);
    }
}

