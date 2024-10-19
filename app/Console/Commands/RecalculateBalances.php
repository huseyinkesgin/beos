<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PersonnelBalance;

class RecalculateBalances extends Command
{
    // Komutun adı
    protected $signature = 'recalculate:balances';

    // Komutun açıklaması
    protected $description = 'Tüm personel bakiyelerini yeniden hesapla';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Tüm bakiyeleri al ve yeniden hesapla
        $balances = PersonnelBalance::all();

        foreach ($balances as $balance) {
            $balance->recalculateBalance();
        }

        $this->info('Tüm personel bakiyeleri başarıyla güncellendi.');
    }
}
