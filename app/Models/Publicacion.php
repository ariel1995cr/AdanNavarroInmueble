<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicacion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'publicacion';

    protected $with = ['publicacion'];

    public function publicacion(){
        return $this->morphTo(__FUNCTION__, 'publicacion_type', 'publicacion_id')->withTrashed();
    }

    public function imagenes(){
        return $this->hasMany(Imagen::class);
    }

    public function consultas(){
        return $this->hasMany(Consulta::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d-m-Y H:i',
    ];

}
