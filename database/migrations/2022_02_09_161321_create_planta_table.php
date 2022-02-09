<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planta', function (Blueprint $table) {
            $table->increments('id_planta');
            $table->string('nombre',100);
            $table->boolean('tipo_venta')->comment('Minorista -> 0, Mayorista -> 1');
            $table->unsignedInteger('id_familia')->index();
            $table->string('direccion_imagen',500);
            $table->string('titulo_imagen',100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('planta');
    }
}
