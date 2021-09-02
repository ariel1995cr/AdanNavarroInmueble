<?php

namespace Database\Seeders;

use App\Models\Modelo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class ModeloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $modelo = new Modelo();
        $modelo->id = 'Cargo';
        $modelo->marca_id = 'Ford';
        $modelo->save();

        $modelo = new Modelo();
        $modelo->id = 'Duster';
        $modelo->marca_id = 'Renault';
        $modelo->save();
    }
}
