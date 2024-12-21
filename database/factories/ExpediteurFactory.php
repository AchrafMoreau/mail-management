<?php

namespace Database\Factories;
use App\Models\Ville;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expediteur>
 */
class ExpediteurFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom' => $this->faker->username(),
            'adresse' => $this->faker->address(),
            'ville_id' => Ville::inRandomOrder()->value('id'),
            'phone' => $this->faker->e164PhoneNumber(),
            'email' => $this->faker->email()
        ];
    }
}
