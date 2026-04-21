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
        'Núcleo Padrón',
        'Código Postal',
        'Número Elector'
    ];
}
