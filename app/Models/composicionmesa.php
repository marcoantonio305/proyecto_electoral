<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComposicionMesa extends Model
{
    protected $table = 'composicionmesa';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
    'Código',
    'Descripción',
    'Dist.',
    'Sec.',
    'Mesa',
    'Cargo',
    'Cargo',
    'Nombre',
    'Apellido 1',
    'Apellido 2',
    'Orden',
    'Documento',
    'Dirección',
    'E. Colectiva',
    'E. Singular',
    'Núcleo',
    'Colegio Electoral',
    'Dirección Colegio Electoral',
    'Dirección Padrón',
    'E. Colectiva Padrón',
    'E. Singular Padrón',
    'Núcleo Padrón',
    'Código Postal',
    'Número Elector'
];
}
/**<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComposicionMesa extends Model
{
    protected $table = 'composicionmesa';
    protected $primaryKey = 'id';

    public $timestamps = false;

    // Estos nombres DEBEN coincidir con los de tu base de datos SQL
    protected $fillable = [
        'codigo',
        'descripcion',
        'dist',
        'sec',
        'mesa',
        'cargo_id',
        'cargo_nombre',
        'nombre',
        'apellido_1',
        'apellido_2',
        'orden',
        'documento',
        'direccion',
        'colegio_electoral',
        'direccion_colegio',
        'numero_elector',
        'e_colectiva',
        'e_singular',
        'nucleo',
        'direccion_padron',
        'e_colectiva_padron',
        'e_singular_padron',
        'nucleo_padron',
        'codigo_postal'
    ];
} */
