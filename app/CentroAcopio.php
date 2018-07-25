<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CentroAcopio extends Model
{
    //Properties
    protected $fillable = ['nombre', 'direccion_exacta', 'activo', 'provincia','user_id'];        

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function canjes(){
        return $this->hasMany('App\Canje');
    }
}
