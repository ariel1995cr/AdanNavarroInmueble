<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consulta';

    protected $fillable = ['id', 'publicacion_id', 'nombreApellido', 'email', 'telefono', 'horario', 'comentario'];
}
