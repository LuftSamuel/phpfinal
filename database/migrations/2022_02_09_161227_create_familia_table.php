<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamiliaTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('familia', function (Blueprint $table) {
            //$table->engine = 'MyISAM';       
            $table->increments('id_familia'); //unsigned integer PK auto increment          
            $table->string('familia', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('familia');
    }

}
