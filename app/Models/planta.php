<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $tabla = 'planta';
}