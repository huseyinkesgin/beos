<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kocaeli = State::where('name', 'Kocaeli')->first();
        $istanbul = State::where('name', 'İstanbul')->first();

        if ($kocaeli && $istanbul) {
            City::create([
                'state_id' => $kocaeli->id,
                'name' => 'Gebze',
                'isActive' => true,
            ]);

            City::create([
                'state_id' => $kocaeli->id,
                'name' => 'Dilovası',
                'isActive' => true,
            ]);

            City::create([
                'state_id' => $kocaeli->id,
                'name' => 'Çayırova',
                'isActive' => true,
            ]);

            City::create([
                'state_id' => $istanbul->id,
                'name' => 'Tuzla',
                'isActive' => true,
            ]);

            City::create([
                'state_id' => $istanbul->id,
                'name' => 'Kartal',
                'isActive' => true,
            ]);
        }
    }
}
