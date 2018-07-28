<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    public $table = "materiales";

    //Properties
    protected $fillable = ['nombre', 'imagen', 'descripcion', 'precio_unitario', 'color', 'activo'];

    public function canjes(){
        return $this->belongsToMany('App\Canje','canje_detalle','material_id','canje_id')->withPivot('cantidad')->withTimestamps();
    }
}
