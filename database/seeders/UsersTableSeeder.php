<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Jose Manuel',
            'email' => 'jgarciacortes1999@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('Konecta2023'),
            'remember_token' => '123456789',
            'dni'=>'48190566T',
            'direccion'=>'Aznalcollar',
            'telefono'=>'647277114',
            'rol'=>'admin',
        ]);
        \App\Models\User::factory()->count(28)->create();
    }
}
