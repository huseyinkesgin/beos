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
        Schema::create('lands', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->decimal('price', 12, 2); // Ücret
            $table->string('zoning_status'); // İmar Durumu
            $table->decimal('area_m2', 10, 2); // m²
            $table->string('lot'); // Ada
            $table->string('parcel'); // Parsel
            $table->string('similar')->nullable(); // Emsal
            $table->string('height_limit')->nullable(); // Gabari
            $table->boolean('isCredit')->default(false); // Krediye Uygunluk
            $table->string('deed_type'); // Tapu Durumu
            $table->string('property_no')->nullable(); // Taşınmaz No
            $table->boolean('isSwap'); // Takas Durumu
            $table->foreignUuid('state_id')->constrained(); // İl
            $table->foreignUuid('city_id')->constrained(); // İlçe
            $table->foreignUuid('district_id')->constrained(); // Bölge
            $table->text('description')->nullable(); // Açıklama
            $table->string('portfolio_no')->nullable(); // Portföy No
            $table->string('advisor'); // Danışman
            $table->boolean('has_partner')->default(false); // Partner Var Mı
            $table->foreignUuid('partner_customer_id')->nullable()->constrained('customers'); // Partner Listesi
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
        Schema::dropIfExists('lands');
    }
};
