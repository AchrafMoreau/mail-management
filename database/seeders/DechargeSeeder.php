<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Decharge;

class DechargeSeeder extends Seeder
{
    public function run()
    {
        // Create test records
        Decharge::create([
            'nom_complet' => 'John Doe',
            'date' => now(),
            'etat' => 'Active',
            'ville' => 'New York',
        ]);

        Decharge::create([
            'nom_complet' => 'Jane Smith',
            'date' => now(),
            'etat' => 'Inactive',
            'ville' => 'Los Angeles',
        ]);

        Decharge::create([
            'nom_complet' => 'Arthur Pendragon',
            'date' => now(),
            'etat' => 'Heroic',
            'ville' => 'Camelot',
        ]);

        Decharge::create([
            'nom_complet' => 'Eowyn Shieldmaiden',
            'date' => now(),
            'etat' => 'Fearless',
            'ville' => 'Rohan',
        ]);

        Decharge::create([
            'nom_complet' => 'Bilbo Baggins',
            'date' => now(),
            'etat' => 'Adventurous',
            'ville' => 'The Shire',
        ]);

        // Feel free to add more records as your saga unfolds...
    }
}