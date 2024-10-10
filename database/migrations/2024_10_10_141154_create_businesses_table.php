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
        Schema::create('businesses', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->decimal('price', 12, 2); // Ücret
            $table->decimal('land_area_m2', 10, 2)->nullable(); // Arsa Alanı
            $table->decimal('open_area', 10, 2)->nullable(); // Açık Alan
            $table->decimal('closed_area', 10, 2)->nullable(); // Kapalı Alan
            $table->unsignedInteger('floor_count')->nullable(); // Kat Sayısı
            $table->unsignedInteger('floor_level')->nullable(); // Kat Seviyesi
            $table->decimal('electricity_power', 8, 2)->nullable(); // Elektrik KWA
            $table->unsignedInteger('building_year')->nullable(); // Yapım Yılı
            $table->boolean('is_factory')->default(false); // Fabrika mı?
            $table->boolean('is_warehouse')->default(false); // Depo mu?
            $table->boolean('is_store')->default(false); // Mağaza mı?
            $table->boolean('is_furnished')->default(false); // Eşyalı mı?
            $table->boolean('loanable')->default(false); // Krediye uygunluk
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
        Schema::dropIfExists('businesses');
    }
};
