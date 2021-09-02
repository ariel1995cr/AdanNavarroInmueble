<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inmueble extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'inmueble';

    protected $fillable = ['id', 'descripcion', 'superficie_total', 'direccion', 'latitud', 'longitud', 'agua', 'luz', 'gas',
        'cloaca', 'ambientes', 'dormitorios', 'banos', 'antiguedad', 'cantidad_pisos', 'pisos_unidad', 'departamentos_por_piso',
        'tipoinmueble_id'];


    public function publicacion(){
        return $this->morphOne(Publicacion::class, 'publicacion')->withTrashed();
    }

    protected $casts = [
        'agua' => 'boolean',
        'luz' => 'boolean',
        'gas' => 'boolean',
        'cloaca' => 'boolean',
        'cochera' => 'boolean',
    ];
}
