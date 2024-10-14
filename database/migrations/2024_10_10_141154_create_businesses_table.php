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
            $table->string('area_m2',)->nullable();
            $table->string('open_area')->nullable();
            $table->string('closed_area')->nullable();
            $table->string('business_area')->nullable();
            $table->string('office_area')->nullable(); 
            $table->unsignedInteger('floor_count')->nullable(); // Kat Sayısı
            $table->unsignedInteger('floor_level')->nullable(); // Kat Seviyesi
            $table->string('electricity_power')->nullable(); //
            $table->unsignedInteger('building_year')->nullable(); // Yapım Yılı
            $table->string('heating_type')->nullable(); //ısıtma tipi
            $table->string('building_condition')->nullable(); //yapının durumu
            $table->string('usage_status')->nullable(); //kullanım durumu
            $table->boolean('ground_analysis')->default(true); //zemin edütü
            $table->string('height')->nullable(); // Yükseklik
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
