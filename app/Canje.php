<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    public $table = "canjes";

    //Properties
    protected $fillable = ['fecha', 'activo','centro_acopio_id', 'user_id'];

    public function centrosacopio(){
        return $this->belongsTo('App\CentroAcopio');
    }

    public function usuario(){
        return $this->belongsTo('App\User');
    }

    public function materiales(){
        return $this->belongsToMany('App\Material','canje_detalle','canje_id','material_id')->withPivot('cantidad')->withTimestamps();
    }
}
