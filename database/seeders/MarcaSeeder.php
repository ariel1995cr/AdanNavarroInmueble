<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class MarcaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $marca = new Marca();
        $marca->id = 'Chevrolet';
        $marca->save();

        $marca = new Marca();
        $marca->id = 'Ford';
        $marca->save();

        $marca = new Marca();
        $marca->id = 'Renault';
        $marca->save();
    }
}
