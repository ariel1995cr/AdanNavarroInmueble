<?php

namespace Database\Seeders;

use App\Models\TipoInmueble;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TipoInmuebleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipoInmueble = new TipoInmueble();
        $tipoInmueble->id = 'Inmueble';
        $tipoInmueble->save();

        $tipoInmueble = new TipoInmueble();
        $tipoInmueble->id = 'Terrenos y Lotes';
        $tipoInmueble->categoria_id = 'Inmueble';
        $tipoInmueble->save();

        $tipoInmueble = new TipoInmueble();
        $tipoInmueble->id = 'Casa';
        $tipoInmueble->categoria_id = 'Inmueble';
        $tipoInmueble->save();

        $tipoInmueble = new TipoInmueble();
        $tipoInmueble->id = 'Departamento';
        $tipoInmueble->categoria_id = 'Inmueble';
        $tipoInmueble->save();
    }
}
