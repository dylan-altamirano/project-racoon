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
    public function tieneAcceso(array $permissions){
        foreach($permissions as $permiso){
          if($this->tienePermiso($permiso)){
            return true;
          }
        }
        return false;
      }

      public function tienePermiso(string $permiso){
        $permisos=json_decode($this->permisos,true);
        return $permisos[$permiso]??false;
      }
}
