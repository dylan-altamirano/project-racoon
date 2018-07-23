<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Canje extends Model
{
    //Properties
    protected $fillable = ['fecha', 'activo','centro_acopio_id', 'user_id'];

    public function centrosacopio(){
        return $this->belongsTo('App\CentroAcopio');
    }

    public function usuario(){
        return $this->belongsTo('App\User');
    }
}
