<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class computerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 50; $i++) {
            DB::table('computers')->insert([
                'computer_name' => $faker->word . ' ' . $faker->word, 
                'model' => $faker->word,  
                'operating_system' => $faker->randomElement(['Windows', 'macOS', 'Linux']),  
                'processor' => $faker->word, 
                'memory' => $faker->numberBetween(4, 64), 
                'available' => $faker->boolean, 
                'created_at' => now(), 
                'updated_at' => now(),
            ]);
        }
    }
}
