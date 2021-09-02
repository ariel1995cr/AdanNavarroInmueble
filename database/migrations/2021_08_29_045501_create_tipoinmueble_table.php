<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoinmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipoinmueble', function (Blueprint $table) {
            $table->string('id');
            $table->string('categoria_id')->nullable();
            $table->timestamps();

            $table->primary('id');
            $table->foreign('categoria_id')->references('id')->on('tipoinmueble');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tipoinmueble');
    }
}
