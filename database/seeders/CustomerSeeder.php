<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $customers = [
            ['name' => 'EKOL LOJİSTİK', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ÖMÜR ÇELİK', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'TAYFUN BEY - REYHAN HANIM', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'CENK SEZER', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MEHMET BİLAL', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'BAŞKANIN YERİ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'RUHİ BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'SÜLEYMAN KILIÇ (KASSO)', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'BARIŞ KALEAĞASI', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MUHARREM SÜRMEN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'DURSUN KELEŞ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MURAT TUĞUTLU', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'METE ÇALIŞKAN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'DİLAVER ŞALLI', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'AYDIN DİNÇER', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ARİF YILAN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'HAYDAR ÇİFTÇİ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'RÜSTEM YURTTAŞ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MURAT DAĞ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'METİN ÇELİK EMLAK', 'category' => 'Emlakçı', 'customer_type' => 'Kurumsal'],
            ['name' => 'MURAT ÇÖKMEZ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ŞAMİL SATICI', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'YAŞAR EMLAK', 'category' => 'Emlakçı', 'customer_type' => 'Bireysel'],
            ['name' => 'HÜSEYİN AYDIN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'SEDAT ERİŞKEN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'CAHİT UÇAR', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ÖMER BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MURAT ERDOĞAN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'GÜLTEZER ÇETİNDAĞ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'SELİM HAYRİ KELEŞ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'İSMAİL KAYA', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'CENK SEZER', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ZEKERİYA ÖZTÜRK', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ALPARSLAN ARTUT', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MURAT YILDIZ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ÇETİN BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'GÜLİZAR HANIM - YAŞAR BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'YILMAZ DOĞAN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'CEM KALKAVAN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'SEPA ALİMİNYUM - ÖMER BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ALAATTİN BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'HAKAN BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MUSTAFA DORALP', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'KAŞİF ŞAHİNKESEN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'ARİF KANİTOĞLU', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'CANER ERDOĞAN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'İMES ONUR BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Bireysel'],
            ['name' => 'SELÇUK YURDUSEVEN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'YUSUF BEY', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'MERMERCİLER İLHAN ABİ', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'VEYSEL GÜÇTEKİN', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'DEM YAPI', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal'],
            ['name' => 'EMLAKÇI TAYFUN', 'category' => 'Emlakçı', 'customer_type' => 'Bireysel'],
            ['name' => 'MURAT GÖK', 'category' => 'Mal Sahibi', 'customer_type' => 'Kurumsal']
        ];

        foreach ($customers as $customer) {
            Customer::create([
                'name' => $customer['name'],
                'category' => $customer['category'],
                'customer_type' => $customer['customer_type'],
                'isActive' => true,  // Varsayılan olarak aktif
            ]);
        }
    }
}
