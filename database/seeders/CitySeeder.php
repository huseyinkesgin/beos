<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $states = State::all();

        if ($states->isEmpty()) {
            // Hata mesajı veya varsayılan durum eklemek isteyebilirsiniz
            return; // Durum yoksa çık
        }

        City::create(attributes: [
            'id' => (string) Str::uuid(),
            'state_id' => $states->first()->id, // İlk durumu al
            'name' => 'Gebze',
            'isActive' => true,
        ]);

        // Diğer şehirleri de ekleyebilirsiniz
        City::create([
            'id' => (string) Str::uuid(),
            'state_id' => $states->first()->id, // İkinci şehir için aynı durumu kullanabilirsiniz
            'name' => 'Dilovası',
            'isActive' => true,
        ]);
    }
}
