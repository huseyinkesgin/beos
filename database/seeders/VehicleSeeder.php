<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::insert([
            [
                'license_plate' => '41 ATD 695',
                'brand' => 'RENAULT',
                'model' => 'MAGANE 1.4',
                'year' => 2024,
                'purchase_date' => '2024-04-24',
                'chassis_number' => '1231313JHJ34',
                'registration_number' => 'TRT4343434F4345',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'license_plate' => '34 BİP 928',
                'brand' => 'WALKSVAGEN',
                'model' => 'PASSAT 1.6TDI',
                'year' => 2021,
                'purchase_date' => '2022-01-25',
                'chassis_number' => '2131313131313',
                'registration_number' => '4564646464646464646',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'license_plate' => '34 NDM 55',
                'brand' => 'MERCEDES',
                'model' => '200E',
                'year' => 2022,
                'purchase_date' => '2022-06-25',
                'chassis_number' => '234424242',
                'registration_number' => '234242423432424',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
