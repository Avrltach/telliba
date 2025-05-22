<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Documents;
use Illuminate\Database\Seeder;

class DokumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++){
            Documents::create([
                
            ]);
         }
    }
}
