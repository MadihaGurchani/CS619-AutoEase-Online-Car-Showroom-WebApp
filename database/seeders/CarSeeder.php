<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\Car::create([
            'cat_id' => 1,  // This should match the ID from your brands table
            'model' => 'Corolla',
            'year' => '2020',
            'description' => 'A reliable toyota with great fuel efficiency.',
            'price' => 2500000,
            'image' => 'images/Toyota Corolla.png',
            'availability' => true,
        ]);

        \App\Models\Car::create([
            'cat_id' => 2,  // This should match the ID from your brands table
            'model' => 'Mehran',
            'year' => '2015',
            'description' => 'A reliable mehran with great fuel efficiency.',
            'price' => 2500000,
            'image' => 'images/Suzuki Mehran.png',
            'availability' => true,
        ]);

        \App\Models\Car::create([
            'cat_id' => 3,  // This should match the ID from your brands table
            'model' => 'City',
            'year' => '2018',
            'description' => 'A reliable honda with great fuel efficiency.',
            'price' => 2500000,
            'image' => 'images/Honda City.png',
            'availability' => true,
        ]);
    }
}
