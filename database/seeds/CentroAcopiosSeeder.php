<?php

use Illuminate\Database\Seeder;

class CentroAcopiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Array centros de acopio
        $centros_acopio = [
            [
                'nombre' => 'ADARFACES',
                'direccion_exacta' => 'Puriscal, San Antonio. 150 m noreste del MAG',
                'activo' => 1,
                'provincia' => 'San José',
                'user_id' => 1
            ],
            [
                'nombre' => 'Recicladora La Calma',
                'direccion_exacta' => 'San José, Central, Barrio Cristo Rey. De la antigua Teletica, 100 m sur y 50 m este',
                'activo' => 1,
                'provincia' => 'San José',
                'user_id' => 2
            ],
            [
                'nombre' => 'Centro de Acopio Recima',
                'direccion_exacta' => 'San Carlos, 700 metros este del Colegio Público de Pital',
                'activo' => 1,
                'provincia' => 'Alajuela',
                'user_id' => 3
            ]
        ];

        foreach($centros_acopio as $centro){

            $centroacopio = new \App\CentroAcopio();
            $centroacopio->nombre = $centro['nombre'];
            $centroacopio->direccion_exacta = $centro['direccion_exacta'];
            $centroacopio->activo = $centro['activo'];
            $centroacopio->provincia = $centro['provincia'];
            $centroacopio->user_id = $centro['user_id'];

            $centroacopio->save();
        }

    }
}
