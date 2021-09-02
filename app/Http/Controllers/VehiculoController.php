<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehiculoSaveRequest;
use App\Models\Imagen;
use App\Models\Inmueble;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Publicacion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class VehiculoController extends Controller
{
    //
    public function index(){
        $marcas = Marca::all();
        $vehiculos = Publicacion::withTrashed()->where('publicacion_type',Vehiculo::class)->paginate()->withQueryString();
        return Inertia::render('Admin/Vehiculos/Index', ['vehiculos'=>$vehiculos, 'marcas'=>$marcas]);
    }


    public function save(VehiculoSaveRequest $request){
        $vehiculo = new Vehiculo($request->all('vehiculo')['vehiculo']);
        $vehiculo->save();

        $publicacion = new Publicacion();
        $publicacion->nombrePublicacion = $request->all()['nombrePublicacion'];
        $publicacion->publicacion()->associate($vehiculo);
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

    public function update(Vehiculo $vehiculo, Request $request){

        $vehiculo->fill($request->all('vehiculo')['vehiculo']);

        $vehiculo->publicacion->nombrePublicacion = $request->all()['nombrePublicacion'];
        $vehiculo->publicacion->save();

        $vehiculo->save();

        return redirect()->back();
    }


    public function delete(Vehiculo $vehiculo){
        $vehiculo->delete();
        $vehiculo->publicacion->delete();

        return redirect()->back();
    }

    public function activate($vehiculo){
        $vehiculo = Vehiculo::onlyTrashed()->find($vehiculo);
        $vehiculo->restore();
        $vehiculo->publicacion->restore();

        return redirect()->back();
    }
}
