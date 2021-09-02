<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    //
    public function obtenerModelos($marca){
        $modelos = Modelo::where('marca_id',$marca)->get();
        return response()->json($modelos);
    }
}
