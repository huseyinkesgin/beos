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
            $table->id();
            $table->foreignUuid('portfolio_id')->constrained;
            $table->decimal('area_m2', 10, 2)->nullable(); // Arsa Alanı
            $table->decimal('open_area', 10, 2)->nullable(); // Açık Alan
            $table->decimal('closed_area', 10, 2)->nullable(); // Kapalı Alan
            $table->decimal('business_area', 10, 2)->nullable(); // Kapalı Alan
            $table->decimal('office_area', 10, 2)->nullable(); // Kapalı Alan
            $table->unsignedInteger('floor_count')->nullable(); // Kat Sayısı
            $table->unsignedInteger('floor_level')->nullable(); // Kat Seviyesi
            $table->decimal('electricity_power', 8, 2)->nullable(); // Elektrik KWA
            $table->unsignedInteger('building_year')->nullable(); // Yapım Yılı
            $table->string('heating_type')->nullable(); //ısıtma tipi
            $table->string('building_condition')->nullable(); //yapının durumu
            $table->string('usage_status')->nullable(); //kullanım durumu
            $table->boolean('ground_analysis')->default(true); //zemin edütü
            $table->string('height')->nullable(); // Yükseklik

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
