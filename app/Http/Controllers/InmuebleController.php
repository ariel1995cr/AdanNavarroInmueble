<?php

namespace App\Http\Controllers;

use App\Http\Requests\InmuebleSaveRequest;
use App\Models\Imagen;
use App\Models\inmueble;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InmuebleController extends Controller
{
    //
    public function index(){
        $publicaciones = Publicacion::withTrashed()->where('publicacion_type',Inmueble::class)->paginate()->withQueryString();
        return Inertia::render('Admin/Inmuebles/Index', ['publicaciones'=>$publicaciones]);
    }

    public  function save(InmuebleSaveRequest $request){
        $inmueble = new Inmueble($request->all('inmueble')['inmueble']);
        $inmueble->save();

        $publicacion = new Publicacion();
        $publicacion->nombrePublicacion = $request->all()['nombrePublicacion'];
        $publicacion->publicacion()->associate($inmueble);
        $publicacion->save();

        foreach ($request->fotos as $key => $foto) {
            $file_name = time().'_'.$key.'_publicacion'.$publicacion->id.'.'.$foto->extension();
            $file_path = $foto->storeAs('uploads', $file_name, 'public');
            $imagen = new Imagen();
            $imagen->publicacion_id = $publicacion->id;
            $imagen->name = $file_name;
            $imagen->path = '/storage/' . $file_path;
            $imagen->save();
        }

        return redirect()->back();
    }

    public function update(Inmueble $inmueble, Request $request){

        $inmueble->fill($request->all('inmueble')['inmueble']);

        $inmueble->publicacion->nombrePublicacion = $request->all()['nombrePublicacion'];
        $inmueble->publicacion->save();

        $inmueble->save();

        return redirect()->back();
    }

    public function delete(Inmueble $inmueble){
        $inmueble->delete();
        $inmueble->publicacion->delete();

        return redirect()->back();
    }

    public function activate($inmueble){
        $inmueble = Inmueble::onlyTrashed()->find($inmueble);
        $inmueble->restore();
        $inmueble->publicacion->restore();
        $publicaciones = Publicacion::withTrashed()->paginate()->withQueryString();

        return Redirect::route('InmueblesIndex');
    }
}
