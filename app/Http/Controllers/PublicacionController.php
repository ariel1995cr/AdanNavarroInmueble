<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConsultaSaveRequest;
use App\Mail\ConsultaMail;
use App\Models\Consulta;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class PublicacionController extends Controller
{
    //
    public function verPublicacion(Publicacion $publicacion){
        $publicacion->imagenes = $publicacion->imagenes;
        return Inertia::render('Home/Publicacion/verPublicacion', ['publicacion'=>$publicacion]);
    }

    public function realizarConsulta(Publicacion $publicacion, ConsultaSaveRequest $request){
        $consulta = new Consulta($request->all());
        $consulta->publicacion_id = $publicacion->id;
        $consulta->save();

        Mail::to('adannavarropage@gmail.com')->send(new ConsultaMail($publicacion->nombrePublicacion, $consulta->nombreApellido,$consulta->telefono, $consulta->horario, $consulta->comentario));

        return redirect()->back();
    }
}
