<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cupon extends Model
{
    public $table = "cupones";

    //Properties
    protected $fillable = ['nombre', 'descripcion', 'cant_ecomonedas','activo','imagen'];

    public function canjecupones(){
        return $this->belongsToMany('App\CanjeCupon','canjecupon_detalle','cupon_id','canjecupon_id')->withPivot('cantidad')->withTimestamps();
    }
}
