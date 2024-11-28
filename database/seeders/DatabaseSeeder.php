<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            CourrierSeeder::class,
        ]);
        // Appeler vos autres seeders ici
        $this->call(DechargeSeeder::class);

        User::create([
            'name' => "demo",
            'email' => "demo@demo.com",
            'password' => Hash::make("password"),
        ]);
    }
}
