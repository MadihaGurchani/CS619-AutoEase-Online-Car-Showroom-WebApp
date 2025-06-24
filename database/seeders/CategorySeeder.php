<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;  // Add this import
use App\Models\Brand;  // Add this import


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['brand' => 'Toyota']);
        Brand::create(['brand' => 'Suzuki']);
        Brand::create(['brand' => 'Honda']);
        Brand::create(['brand' => 'Nissan']);
    }
}
