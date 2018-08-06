<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroAcopio extends Model
{

    public $table = "centro_acopios";

    //Properties
    protected $fillable = ['nombre', 'direccion_exacta', 'activo', 'provincia','user_id'];        

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function canjes(){
        return $this->hasMany('App\Canje');
    }
}
