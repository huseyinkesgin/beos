<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        if ($categories->isEmpty()) {
            // Hata mesajı veya varsayılan durum eklemek isteyebilirsiniz
            return; // Durum yoksa çık
        }

        Type::create(attributes: [
            'id' => (string) Str::uuid(),
            'category_id' => $categories->first()->id, // İlk durumu al
            'name' => 'Ticari Arsa',
            'isActive' => true,
        ]);

        // Diğer şehirleri de ekleyebilirsiniz
        Type::create([
            'id' => (string) Str::uuid(),
            'category_id' => $categories->first()->id, // İkinci şehir için aynı durumu kullanabilirsiniz
            'name' => 'Sanayi Arsası',
            'isActive' => true,
        ]);

        Type::create([
            'id' => (string) Str::uuid(),
            'category_id' => $categories->first()->id, // İkinci şehir için aynı durumu kullanabilirsiniz
            'name' => 'Konut Arsası',
            'isActive' => true,
        ]);

        Type::create([
            'id' => (string) Str::uuid(),
            'category_id' => $categories->first()->id, // İkinci şehir için aynı durumu kullanabilirsiniz
            'name' => 'Diğer Tarım Arsası',
            'isActive' => true,
        ]);
    }
}
