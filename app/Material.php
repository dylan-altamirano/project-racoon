<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    //Properties
    protected $fillable = ['nombre', 'imagen', 'precio_unitario', 'color', 'activo'];
}
