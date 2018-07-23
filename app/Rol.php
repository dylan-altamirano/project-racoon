<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //properties
    protected $fillable = ['nombre', 'permisos', 'activo'];
}
