<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Music', 
        'Sports', 
        'Business', 
        'Technology', 
        'Food', 
        'Fashion', 
        'Art', 
        'Education',
        'Health',
        'Travel',
        'Entertainment',
        'Science',
        'Finance',
        'Automotive',
        'Gaming'];

        // Loop through the array and create categories
        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
