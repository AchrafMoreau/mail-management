<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;



use App\Models\User;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Emetteur;
use App\Models\Courrire;
use App\Models\Decharge;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $citiesPath = database_path('seeders/sql/cities.sql');
        $regionPath = database_path('seeders/sql/region.sql');

        $regionSql = File::get($regionPath);
        $citiesSql = File::get($citiesPath);

        DB::unprepared($regionSql);
        DB::unprepared($citiesSql);

        $this->command->info('SQL file imported successfully!');

        if(!User::where('name', 'admin')->first()){
            User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make("password"),
                'role' => "ADMIN"
            ]);
        }

        Emetteur::factory(10)->create();
        Courrire::factory(100)->create();
        Decharge::factory(10)->create();
        
        $this->command->info('Seeder imported successfully!');
        
    }

}
