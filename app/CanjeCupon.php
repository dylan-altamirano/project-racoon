<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CanjeCupon extends Model
{
    //Properties
    protected $fillable = ['fecha', 'activo', 'user_id'];

     public function usuario(){
        return $this->belongsTo('App\User');
    }
}
