<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Planta extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'planta';
    protected $primaryKey = 'id_planta';

    public function getSiguienteId(){
        $statement = DB::select("SHOW TABLE STATUS LIKE 'planta'");
        $nextId = $statement[0]->Auto_increment;
    }
    
}
