<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arsaCategory = Category::where('name', 'Arsa')->first();
        $isyeriCategory = Category::where('name', 'İşyeri')->first();
        $konutCategory = Category::where('name', 'Konut')->first();

        if ($arsaCategory) {
            Type::create([
                'category_id' => $arsaCategory->id,
                'name' => 'Arsa',
                'form_path' => "admin.portfolio.forms.Arsa-form",
                'isActive' => true
            ]);
            Type::create([
                'category_id' => $arsaCategory->id,
                'name' => 'Tarla',
                'form_path' => "admin.portfolio.forms.Arsa-form",
                'isActive' => true
            ]);
        }

        if ($isyeriCategory) {
            Type::create([
                'category_id' => $isyeriCategory->id,
                'name' => 'Fabrika',
                'form_path' => "admin.portfolio.forms.Fabrika-form",
                'isActive' => true
            ]);
            Type::create([
                'category_id' => $isyeriCategory->id,
                'name' => 'Depo',
                'form_path' => "admin.portfolio.forms.Depo-form",
                'isActive' => true
            ]);
            Type::create([
                'category_id' => $isyeriCategory->id,
                'name' => 'Dükkan',
                'form_path' => "admin.portfolio.forms.Magaza-form",
                'isActive' => true
            ]);
        }

        if ($konutCategory) {
            Type::create([
                'category_id' => $konutCategory->id,
                'name' => 'Daire',
                'form_path' => "admin.portfolio.forms.Daire-form",
                'isActive' => true
            ]);
            Type::create([
                'category_id' => $konutCategory->id,
                'name' => 'Rezidans',
                'form_path' => "admin.portfolio.forms.Daire-form",
                'isActive' => true
            ]);
            Type::create([
                'category_id' => $konutCategory->id,
                'name' => 'Villa',
                'form_path' => "admin.portfolio.forms.Daire-form",
                'isActive' => true
            ]);
        }
    }
}
