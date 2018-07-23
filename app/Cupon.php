<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    //Properties
    protected $fillable = ['nombre', 'descripcion', 'cant_ecomonedas','activo'];
}
