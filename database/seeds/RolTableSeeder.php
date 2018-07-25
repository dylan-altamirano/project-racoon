<?php

use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Array of roles
        $roles = [
            [
                'nombre' => 'Administrador',
                'permisos' => '{"admin-all":true}',
                'activo' => 1
            ],
             [
                'nombre' => 'Administrador Centro Acopio',
                'permisos' => '{"admin-center":true}',
                'activo' => 1
             ],
             [
                'nombre' => 'Cliente',
                'permisos' => '{"cliente":true}',
                'activo' => 1
             ]
        ];

        foreach($roles as $rol){

            $role = new \App\Rol();

            $role->nombre = $rol['nombre'];
            $role->permisos = $rol['permisos'];
            $role->activo = $rol['activo'];

            $role->save();
        }
    }
}
