<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PersonnelExpense;
use Carbon\Carbon;

class PersonnelExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PersonnelExpense::insert([
            [
                'personnel_id' => 1,
                'expense_type' => 'market',
                'note' => 'yoğurt',
                'amount' => 100.00,
                'payment_method' => 'Nakit',
                'expense_date' => Carbon::create(2024, 10, 18),
                'has_receipt' => 1,
                'created_at' => Carbon::create(2024, 10, 18, 11, 52, 3),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 10, 10),
            ],
            [
                'personnel_id' => 1,
                'expense_type' => 'Pazar',
                'note' => 'Kavun',
                'amount' => 1000.00,
                'payment_method' => 'Kredi Kartı',
                'expense_date' => Carbon::create(2024, 10, 16),
                'has_receipt' => 1,
                'created_at' => Carbon::create(2024, 10, 18, 10, 4, 30),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 12, 45),
            ],
            [
                'personnel_id' => 4,
                'expense_type' => 'Ofis',
                'note' => 'kalem',
                'amount' => 125.00,
                'payment_method' => 'Nakit',
                'expense_date' => Carbon::create(2024, 10, 15),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 4, 57),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 13, 32),
            ],
            // Diğer verileri eklemeye devam edebilirsiniz
            [
                'personnel_id' => 4,
                'expense_type' => 'Araç',
                'note' => 'Yıkama',
                'amount' => 300.00,
                'payment_method' => 'Kredi Kartı',
                'expense_date' => Carbon::create(2024, 10, 17),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 7, 38),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 12, 1),
            ],
            [
                'personnel_id' => 4,
                'expense_type' => 'Pazar',
                'note' => 'sebze',
                'amount' => 250.00,
                'payment_method' => 'Kredi Kartı',
                'expense_date' => Carbon::create(2024, 10, 16),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 8, 36),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 12, 51),
            ],
            [
                'personnel_id' => 1,
                'expense_type' => 'Araç',
                'note' => 'Yıkama',
                'amount' => 300.00,
                'payment_method' => 'Kredi Kartı',
                'expense_date' => Carbon::create(2024, 10, 17),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 15, 56),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 12, 18),
            ],
            [
                'personnel_id' => 1,
                'expense_type' => 'Su',
                'note' => 'hazır su',
                'amount' => 444.00,
                'payment_method' => 'Kredi Kartı',
                'expense_date' => Carbon::create(2024, 10, 9),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 16, 13),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 13, 22),
            ],
            [
                'personnel_id' => 1,
                'expense_type' => 'Market',
                'note' => '',
                'amount' => 500.00,
                'payment_method' => 'Nakit',
                'expense_date' => Carbon::create(2024, 10, 2),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 20, 21),
                'updated_at' => Carbon::create(2024, 10, 18, 10, 20, 21),
            ],
            [
                'personnel_id' => 4,
                'expense_type' => 'Diğer',
                'note' => 'temilzik bezi',
                'amount' => 587.00,
                'payment_method' => 'Kredi Kartı',
                'expense_date' => Carbon::create(2024, 10, 9),
                'has_receipt' => 0,
                'created_at' => Carbon::create(2024, 10, 18, 10, 20, 37),
                'updated_at' => Carbon::create(2024, 10, 18, 12, 13, 54),
            ],
            // Diğer veriler...
        ]);
    }
}
