<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CourrierSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['type' => 'entrant', 'date' => '2024-07-10', 'objet' => 'Objet 1', 'adresse_emetteur' => 'Adresse 1', 'emetteur' => 'Emetteur 1', "division" => "Rh", 'observation' => 'Observation 1', 'image_scan' => 'R.jpg', 'date_creation' => Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'sortant', 'date' => '2024-07-15', 'objet' => 'Objet 2', 'adresse_emetteur' => 'Adresse 2', 'emetteur' => 'Emetteur 2', "division" => "administration", 'observation' => 'Observation 2', 'image_scan' => 'R.jpg', 'date_creation' => Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'entrant', 'date' => '2024-07-20', 'objet' => 'Objet 3', 'adresse_emetteur' => 'Adresse 3', 'emetteur' => 'Emetteur 3', "division" => "administration", 'observation' => 'Observation 3', 'image_scan' => 'R.jpg', 'date_creation' => Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'entrant', 'date' => '2024-06-10', 'objet' => 'Objet 4', 'adresse_emetteur' => 'Adresse 4', 'emetteur' => 'Emetteur 1', "division" => "gestion", 'observation' => 'Observation 1', 'image_scan' => 'R.jpg', 'date_creation' => Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['type' => 'sortant', 'date' => '2024-08-15', 'objet' => 'Objet 5', 'adresse_emetteur' => 'Adresse 5', 'emetteur' => 'Emetteur 2', "division" => "Rh", 'observation' => 'Observation 2', 'image_scan' => 'R.jpg', 'date_creation' => Carbon::now(), 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ];

        DB::table('courriers')->insert($data);

        // Vérification des données insérées
        // dd(DB::table('courriers')->get());
    }
}
