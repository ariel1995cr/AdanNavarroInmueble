<?php

namespace App\Http\Controllers;

use App\Models\Publicacion;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    //
    public function index(){
        $publicaciones = Publicacion::with('imagenes')->get();
        return Inertia::render('Home/Index', ['publicaciones'=>$publicaciones]);
    }
}
