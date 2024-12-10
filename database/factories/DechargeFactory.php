<?php

namespace Database\Factories;

use App\Models\Region;
use App\Models\Ville;

// use App\Models\Emetteur;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Decharge>
 */
class DechargeFactory extends Factory
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
            'reception_jour' => $this->faker->date(),
            'etat_id' => Region::inRandomOrder()->value('id'),
            'ville_id' => Ville::inRandomOrder()->value('id'),
            'document' => $this->faker->mimeType()
        ];
    }
}
