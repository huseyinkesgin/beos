<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Arsa',
            'isActive' => true,
        ]);

        Category::create([
            'name' => 'İşyeri',
            'isActive' => true,
        ]);

        Category::create([
            'name' => 'Konut',
            'isActive' => true,
        ]);
    }
}
