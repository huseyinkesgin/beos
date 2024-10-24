<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('personnels')->insert([
            [
                'id' => 1,
                'first_name' => 'Nedim',
                'last_name' => 'Akbacak',
                'email' => 'nedim@buradayapi.com.tr',
                'phone' => '05073000000',
                'job_title' => 'Şirket Sahibi',
                'hire_date' => '2003-04-10',
                'termination_date' => null,
                'isActive' => 1,
                'created_at' => Carbon::parse('2024-10-16 04:28:23'),
                'updated_at' => Carbon::parse('2024-10-16 04:29:12'),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'first_name' => 'Ömer Bahadır',
                'last_name' => 'Gülseren',
                'email' => 'omer@buradayapi.com.tr',
                'phone' => '05301736023',
                'job_title' => 'Danışman',
                'hire_date' => '2020-06-15',
                'termination_date' => null,
                'isActive' => 1,
                'created_at' => Carbon::parse('2024-10-15 07:22:33'),
                'updated_at' => Carbon::parse('2024-10-15 08:12:35'),
                'deleted_at' => null,
            ],


            [
                'id' => 3,
                'first_name' => 'Necla',
                'last_name' => 'Küplüce',
                'email' => 'necla@buradayapi.com.tr',
                'phone' => '0505 366 55 44',
                'job_title' => 'Mutfak Sorumlusu',
                'hire_date' => '2020-09-14',
                'termination_date' => null,
                'isActive' => 1,
                'created_at' => Carbon::parse('2024-10-18 10:49:28'),
                'updated_at' => Carbon::parse('2024-10-18 10:49:28'),
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'first_name' => 'Abdurrahman',
                'last_name' => 'Kılıç',
                'email' => 'kilic@buradayapi.com.tr',
                'phone' => '05301736020',
                'job_title' => 'Danışman',
                'hire_date' => '2020-09-18',
                'termination_date' => null,
                'isActive' => 1,
                'created_at' => Carbon::parse('2024-10-18 10:47:41'),
                'updated_at' => Carbon::parse('2024-10-18 10:47:41'),
                'deleted_at' => null,
            ],
            [
                'id' => 5,
                'first_name' => 'Hüseyin',
                'last_name' => 'Kesgin',
                'email' => 'info@buradayapi.com.tr',
                'phone' => '05301736020',
                'job_title' => 'Bilgi İşlem',
                'hire_date' => '2024-06-10',
                'termination_date' => null,
                'isActive' => 1,
                'created_at' => Carbon::parse('2024-10-16 04:28:23'),
                'updated_at' => Carbon::parse('2024-10-16 04:29:12'),
                'deleted_at' => null,
            ],


        ]);
    }
}
