<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['ANTONIO','JOSE','FRANCISCO','JUAN','MANUEL','PEDRO','JESUS','ANGEL','MIGUEL','JAVIER','JOSE ANTONIO','DAVID','CARLOS','JOSE LUIS','ALEJANDRO','MIGUEL ANGEL','FRANCISCO JAVIER','RAFAEL','DANIEL','JUAN JOSE','LUIS','PABLO','JUAN ANTONIO','JOAQUIN','SERGIO','FERNANDO','JUAN CARLOS','ANDRES','JOSE    MANUEL','JOSE MARIA','RAMON','RAUL','ALBERTO','ENRIQUE','ALVARO','VICENTE','EMILIO','FRANCISCO JOSE','DIEGO','JULIAN','JORGE','ALFONSO','ADRIAN','RUBEN','SANTIAGO','IVAN','JUAN MANUEL','PASCUAL','JOSE MIGUEL','MARIO']),
            'email' => 'prueba'.fake()->randomNumber(5).'@gmail.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('prueba'),
            'remember_token' => Str::random(10),
            'dni'=>fake()->randomNumber(8,8).strtoupper(Str::random(1)),
            'direccion'=>fake()->randomElement(['Aznalcollar','San Juan','Tomares','Bollullos','Pilas']),
            'telefono'=>'6'.fake()->randomNumber(8),
            'rol'=>fake()->randomElement(['cliente']),

            // php artisan db:seed para añadir
            // php artisan migrate:refresh --seed vaciar y meter
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }




}
