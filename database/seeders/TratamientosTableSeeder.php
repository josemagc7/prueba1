<?php

namespace Database\Seeders;
use App\Models\tratamiento;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TratamientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tratamientos=[
            'Corte de pelo',
            'Mechas Rubias',
            'Recortar puntas',
            'Peinar',
            'Mechas Azules'
        ];
        foreach ($tratamientos as $value) {
            tratamiento::create([
                'tratamiento'=> $value,
                'precio'=>fake()->randomElement(['10.00','20.00','12.00','16,30']),
                'descripcion'=>fake()->randomElement(['Mujer','Hombre/Mujer','Hombre'])
            ]);

        }
    }
}
