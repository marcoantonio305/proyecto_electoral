<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComposicionMesa extends Model
{
    protected $table = 'composicionmesa';
    protected $primaryKey = 'id';

    public $timestamps = false;

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
    'numero_elector'
];
}
