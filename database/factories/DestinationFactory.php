<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Ville;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Destination>
 */
class DestinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'nom' => $this->faker->username(),
            'adresse' => $this->faker->address(),
            'ville_id' => Ville::inRandomOrder()->value('id'),
            'phone' => $this->faker->e164PhoneNumber(),
            'zip' => 81000,
            'email' => $this->faker->email()
        ];
    }
}
