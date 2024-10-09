<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Str;
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
            'id' => (string) Str::uuid(),
            'name' => 'Arsa',
            'isActive' => true,
        ]);

        Category::create([
            'id' => (string) Str::uuid(),
            'name' => 'İşyeri',
            'isActive' => true,
        ]);

        Category::create([
            'id' => (string) Str::uuid(),
            'name' => 'Konut',
            'isActive' => true,
        ]);
    }
}
