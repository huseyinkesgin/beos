<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Database\Seeders\VehicleSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(100)->create();

        $this->call([
            StateSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            CustomerSeeder::class,
            PersonnelSeeder::class,
            PersonnelExpenseSeeder::class,
            VehicleSeeder::class,
        ]);

        User::factory()->create([
            'name' => 'Burada Yapı',
            'email' => 'info@buradayapi.com.tr',
            'email_verified_at' => now(),
            'password' => Hash::make('Burada2024'),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'remember_token' => Str::random(10),
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);
    }
}
