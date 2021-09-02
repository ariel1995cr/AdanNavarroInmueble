<?php

namespace Database\Seeders;

use App\Models\TipoVehiculo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tipoVehiculo = new TipoVehiculo();
        $tipoVehiculo->id = 'Vehiculo';
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoVehiculo();
        $tipoVehiculo->id = 'Auto';
        $tipoVehiculo->categoria_id = 'Vehiculo';
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoVehiculo();
        $tipoVehiculo->id = 'Camioneta';
        $tipoVehiculo->categoria_id = 'Vehiculo';
        $tipoVehiculo->save();

        $tipoVehiculo = new TipoVehiculo();
        $tipoVehiculo->id = 'Maquina vial';
        $tipoVehiculo->categoria_id = 'Vehiculo';
        $tipoVehiculo->save();
    }
}
