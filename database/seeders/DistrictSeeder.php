<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gebze = City::where('name', 'Gebze')->first();
        $dilovasi = City::where('name', 'Dilovası')->first();
        $cayirova = City::where('name', 'Çayırova')->first();
        $tuzla = City::where('name', 'Tuzla')->first();

        // Gebze için bölgeler
        $gebzeDistricts = [
            'Balçık', 'Pelitli', 'Denizli', 'Güzeller', 'Plastikçiler OSB'
        ];

        foreach ($gebzeDistricts as $districtName) {
            District::create([
                'city_id' => $gebze->id,
                'state_id' => $gebze->state_id,
                'name' => $districtName,
                'isActive' => true
            ]);
        }

        // Dilovası için bölgeler
        $dilovasiDistricts = [
            'Köseler', 'Tepecik', 'Demirciler', 'Kobi OSB', 'İMES OSB', 'Makinacılar OSB'
        ];

        foreach ($dilovasiDistricts as $districtName) {
            District::create([
                'city_id' => $dilovasi->id,
                'state_id' => $dilovasi->state_id,
                'name' => $districtName,
                'isActive' => true
            ]);
        }

        // Çayırova için bölge
        District::create([
            'city_id' => $cayirova->id,
            'state_id' => $cayirova->state_id,
            'name' => 'Şekerpınar',
            'isActive' => true
        ]);

        // Tuzla için bölgeler
        $tuzlaDistricts = [
            'Deri Sanayi', 'Orhanlı'
        ];

        foreach ($tuzlaDistricts as $districtName) {
            District::create([
                'city_id' => $tuzla->id,
                'state_id' => $tuzla->state_id,
                'name' => $districtName,
                'isActive' => true
            ]);
        }
    }
}
