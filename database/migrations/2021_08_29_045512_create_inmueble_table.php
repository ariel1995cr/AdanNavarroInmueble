<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmueble', function (Blueprint $table) {
            $table->id();
            $table->longText('descripcion');
            $table->decimal('superficie_total')->nullable();
            $table->string('direccion');
            $table->decimal('latitud')->nullable();
            $table->decimal('longitud')->nullable();
            $table->boolean('agua')->nullable();
            $table->boolean('luz')->nullable();
            $table->boolean('gas')->nullable();
            $table->boolean('cloaca')->nullable();
            $table->integer('ambientes')->nullable();
            $table->integer('dormitorios')->nullable();
            $table->integer('banos')->nullable();
            $table->integer('antiguedad')->nullable();
            $table->integer('cantidad_pisos')->nullable();
            $table->integer('pisos_unidad')->nullable();
            $table->integer('departamentos_por_piso')->nullable();
            $table->string('tipoinmueble_id');
            $table->softDeletes();
            $table->timestamps();
            $table->foreign('tipoinmueble_id')->references('id')->on('tipoinmueble');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inmueble');
    }
}
