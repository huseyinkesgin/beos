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
        Schema::create('homes', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->decimal('price', 12, 2); // Ücret
            $table->decimal('area_m2', 10, 2); // m²
            $table->string('room_count'); // Oda Sayısı (ör. 2+1)
            $table->unsignedInteger('floor_level'); // Kaçıncı Kat
            $table->unsignedInteger('total_floors'); // Toplam Kat Sayısı
            $table->boolean('is_furnished')->default(false); // Eşyalı mı
            $table->boolean('isCredit')->default(false); // Krediye uygunluk
            $table->string('deed_type'); // Tapu Çeşidi
            $table->string('property_no')->nullable(); // Taşınmaz No
            $table->foreignUuid('state_id')->constrained(); // İl
            $table->foreignUuid('city_id')->constrained(); // İlçe
            $table->foreignUuid('district_id')->constrained(); // Bölge
            $table->string('lot'); // Ada
            $table->string('parcel'); // Parsel
            $table->text('description')->nullable(); // Açıklama
            $table->string('portfolio_no')->nullable(); // Portföy No
            $table->string('advisor')->nullable(); // Danışman
            $table->foreignUuid('partner_customer_id')->nullable()->constrained('customers'); // Partner
            $table->foreignUuid('owner_customer_id')->nullable()->constrained('customers'); // Mal Sahibi
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
        Schema::dropIfExists('homes');
    }
};
