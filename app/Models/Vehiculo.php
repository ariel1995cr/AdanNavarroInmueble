<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vehiculo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'vehiculo';

    protected $fillable = ['id', 'marca_id', 'descripcion', 'direccion','modelo_id', 'ano', 'color', 'tipo_combustible', 'puertas', 'transmision', 'motor', 'km',
        'horas_trabajadas', 'velocidades', 'capacidad_tanque', 'potencia', 'peso', 'capacidad_balde', 'capacidad_carga',
        'capacidad_cuchara', 'tipovehiculo_id','latitud', 'longitud'];

    public function publicacion(){
        return $this->morphOne(Publicacion::class, 'publicacion')->withTrashed();
    }
}
