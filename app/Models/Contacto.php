<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contacto extends Model {

    public $timestamps = false;
    use HasFactory;
    protected $table = 'contacto';
    //protected $primaryKey = 'id';
    
    //por algun motivo no me deja dar de alta con este modelo, pero con los otros si
    //Add [_token] to fillable property to allow mass assignment on [App\Models\Contacto].
    public $fillable = ['nombre', 'email', 'motivo', 'mensaje'];

}
