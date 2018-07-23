<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroAcopio extends Model
{
    //Properties
    protected $fillable = ['nombre', 'direccion_exacta', 'activo', 'provincia'];        
}
