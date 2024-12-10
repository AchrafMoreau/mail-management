<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Emetteur;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courrire>
 */
class CourrireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $dataTime = $this->faker->dateTimeBetween("-60 days", "+30 days");
        return [
            //
            'type' => $this->faker->randomElement(['SORTANT', 'ENTRANT']),
            'reception_jour' => $dataTime->format("Y-m-d"),
            'reception_heure' => $this->faker->time(),
            'object' => $this->faker->sentence(),
            'emetteur_id' => Emetteur::inRandomOrder()->value('id'),
            'observation' => $this->faker->paragraph(),
            'division' => $this->faker->randomElement(['Administration', 'Ressource Humains', 'Gestion']),
            'document' => $this->faker->mimeType(),
        ];
    }
}
