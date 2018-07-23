<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'direccion','telefono','activo','balance_ecomonedas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Relación de muchos a muchos con la tabla roles
    public function roles(){
        return $this->belongsToMany('App\Rol','rol_user','user_id','rol_id')->withTimestamps();
    }

    public function canjes(){
        return $this->hasMany('App\Canje');
    }

    public function canjescupon(){
        return $this->hasMany('App\CanjeCupon');
    }
}
