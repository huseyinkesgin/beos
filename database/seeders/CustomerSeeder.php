<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Mal Sahibi', 'Partner', 'Emlakçı', 'Referans', 'Alıcı'];
        $firstNames = ['Ahmet', 'Mehmet', 'Zeynep', 'Ayşe', 'Ali', 'Burcu', 'Cem', 'Derya', 'Elif', 'Fatma', 'Musa', 'Ömer'];
        $lastNames = ['Yılmaz', 'Kaya', 'Demir', 'Çelik', 'Yıldız', 'Şahin', 'Aydın', 'Koç', 'Öztürk', 'Güler','Topçu','Yılmaz','Keskin'];

        for ($i = 0; $i < 45; $i++) {
            $firstName = $firstNames[array_rand($firstNames)];
            $lastName = $lastNames[array_rand($lastNames)];
            $email = strtolower($firstName) . '.' . strtolower($lastName) . '@example.com';
            $phone = '05' . rand(30, 59) . rand(1000000, 9999999);

            Customer::create([
             
                'name' => "$firstName $lastName",
                'email' => $email,
                'phone' => $phone,
                'category' => $categories[array_rand($categories)],
                'customer_type' => rand(0, 1) ? 'Bireysel' : 'Kurumsal',
                'isActive' => true,
            ]);
        }
    }
}
