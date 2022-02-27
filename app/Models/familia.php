<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Familia extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $table = 'familia';
    protected $primaryKey = 'id_familia';
}
