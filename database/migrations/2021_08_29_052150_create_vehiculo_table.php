<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiculoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion');
            $table->string('marca_id');
            $table->string('modelo_id');
            $table->integer('ano');
            $table->string('color');
            $table->string('direccion');
            $table->decimal('latitud')->nullable();
            $table->decimal('longitud')->nullable();
            $table->string('tipo_combustible');
            $table->integer('puertas');
            $table->string('transmision')->nullable();
            $table->string('motor')->nullable();
            $table->integer('km');
            $table->integer('horas_trabajadas')->nullable();
            $table->string('velocidades')->nullable();
            $table->string('capacidad_tanque')->nullable();
            $table->string('potencia')->nullable();
            $table->string('peso')->nullable();
            $table->string('capacidad_balde')->nullable();
            $table->string('capacidad_carga')->nullable();
            $table->string('capacidad_cuchara')->nullable();
            $table->string('tipovehiculo_id');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('marca_id')->references('id')->on('marca');
            $table->foreign('modelo_id')->references('id')->on('modelo');
            $table->foreign('tipovehiculo_id')->references('id')->on('tipovehiculo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehiculo');
    }
}
