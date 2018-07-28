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

    //Relacion 1:1 con los centros de acopio
    public function centroacopio(){
        return $this->hasOne('App\CentroAcopio');
    }

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


    public function tieneAcceso(array $permissions){
        foreach($this->roles as $role){
          if($role->tieneAcceso($permissions)){
            return true;
          }
        }
        return false;
      }
      public function tieneRol($name){
        return $this->roles()->where('name',$name)->count()==1;
      }
}
