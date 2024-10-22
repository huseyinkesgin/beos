<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('state_id')->constrained(); // İl
            $table->foreignId('city_id')->constrained(); // İlçe
            $table->foreignId('district_id')->constrained(); // Bölge
            $table->foreignId('category_id')->constrained(); //kategori
            $table->foreignId('type_id')->constrained(); // emlak tipi
            $table->string('portfolio_no')->nullable(); // Portföy No
            $table->string('area_m2'); // Ada
            $table->string('lot'); // Ada
            $table->string('parcel'); // Parsel
            $table->string('price'); // Ücret
            $table->string('status')->default('Satılık'); // Satılık veya Kiralık
            $table->string('deposit')->nullable(); // Kiralık için depozito
            $table->string('additional_fees')->nullable(); // + KDV, + Stopaj, Bilinmiyor
            $table->string('property_no')->nullable(); // Taşınmaz No
            $table->string('isCredit')->default('Uygun Değil')->nullable(); // Krediye Uygunluk
            $table->string('deed_type'); // Tapu Durumu
            $table->string('isSwap')->default('Hayır')->nullable(); // Takas Durumu
            $table->text('description')->nullable(); // Açıklama
            $table->string('advisor')->nullable(); // Danışman
            $table->foreignId('partner_customer_id')->nullable()->constrained('customers'); // Partner
            $table->foreignId('owner_customer_id')->nullable()->constrained('customers'); // Mal Sahibi
            $table->boolean('isActive')->default(true);
            $table->text('note')->nullable();
            $table->softDeletes(); // Soft delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
