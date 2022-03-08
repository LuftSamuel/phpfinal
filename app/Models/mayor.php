<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mayor extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'mayor';
    protected $primaryKey = 'id_planta';
}
