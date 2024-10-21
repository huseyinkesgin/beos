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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('license_plate')->unique(); // Plaka numarası (benzersiz)
            $table->string('brand'); // Araç markası
            $table->string('model'); // Araç modeli
            $table->year('year'); // Üretim yılı
            $table->date('purchase_date')->nullable(); // Satın alma tarihi
            $table->date('sell_date')->nullable(); // Satın alma tarihi
            $table->string('chassis_number')->nullable(); // Şasi numarası
            $table->string('registration_number')->nullable(); // Trafik tescil numarası
            $table->boolean('isActive')->default(true); // Araç aktif mi
            $table->string('registration_image_path')->nullable(); // Ruhsat resmi
            $table->string('insurance_policy_image_path')->nullable(); // Sigorta poliçesi resmi
            $table->date('insurance_policy_expiry')->nullable(); // Sigorta poliçesi bitiş tarihi
            $table->string('casco_policy_image_path')->nullable(); // Kasko poliçesi resmi
            $table->date('casco_policy_expiry')->nullable(); // Kasko poliçesi bitiş tarihi
            $table->json('additional_documents')->nullable(); // Ek belgeler (PDF gibi dosyaların yolu JSON formatında tutulacak)
            $table->date('sell_date')->nullable();
            $table->timestamps(); // created_at ve updated_at
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
