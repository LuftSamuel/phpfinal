<?php

namespace Database\Seeders;

use App\Models\Familia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $array = ['helechos','orquideas','cactus','arboles frutales'];
        foreach($array as $elemento){
            $obj = new Familia();
            $obj->familia = $elemento;
            $obj->save();
        }
    }
}
