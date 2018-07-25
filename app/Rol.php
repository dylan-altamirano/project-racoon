<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    public $table = "roles";

    //properties
    protected $fillable = ['nombre', 'permisos', 'activo'];

    //relación con la tabla users
    public function users(){
        return $this->belongsToMany('App\User','rol_user','rol_id','user_id')->withTimestamps();
    }
}
