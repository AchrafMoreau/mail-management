<?php

namespace Database\Factories;

use App\Models\Expediteur;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mail>
 */
class MailFactory extends Factory
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
            'destination_id' => Destination::inRandomOrder()->value('id'),
            'expediteur_id' => Expediteur::inRandomOrder()->value('id'),
            'observation' => $this->faker->paragraph(),
            // 'division' => $this->faker->randomElement(['Administration', 'Ressource Humains', 'Gestion']),
            'document' => $this->faker->mimeType(),
        ];
    }
}
