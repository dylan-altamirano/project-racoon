<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Array of users
        $users = [
            [
                'name' => 'John Doe',
                'email' => 'jdoe@gmail.com',
                'password' => bcrypt('123456'),
                'direccion' => ' Llorente de Tibás, 400 metros al este del cruce',
                'telefono' => '(506) 268-6243',
                'activo' => 1,
                'balance_ecomonedas' => 0.0
            ],
             [
                'name' => 'Frederick Mae',
                'email' => 'fmae@aol.com',
                'password' => bcrypt('123456'),
                'direccion' => ' San José, 400 norte de la antigua Embajada Americana, edificio Ricardo Padilla',
                'telefono' => '2257-4303',
                'activo' => 1,
                'balance_ecomonedas' => 0.0
            ],
            [
                'name' => 'Catherina Salvo',
                'email' => 'cthsalvo@yahoo.com',
                'password' => bcrypt('123456'),
                'direccion' => '100 m Oeste del Costado Sur-Oeste de la Iglesia La Agonía.',
                'telefono' => '2257-4303',
                'activo' => 1,
                'balance_ecomonedas' => 0.0
            ]
        ];

        
        foreach($users as $usuariop){

            $usuario = new \App\User();
            $usuario->name = $usuariop['name'];
            $usuario->email = $usuariop['email'];
            $usuario->password = $usuariop['password'];
            $usuario->direccion = $usuariop['direccion'];
            $usuario->telefono = $usuariop['telefono'];
            $usuario->activo = $usuariop['activo'];
            $usuario->balance_ecomonedas = $usuariop['balance_ecomonedas'];

            $usuario->save();
        }
    }
}
