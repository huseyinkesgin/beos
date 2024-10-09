<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        State::create([
            'id' => (string) Str::uuid(),
            'name' => 'Kocaeli',
            'isActive' => true,
        ]);

        State::create([
            'id' => (string) Str::uuid(),
            'name' => 'İstanbul',
            'isActive' => true,
        ]);
    }
}
