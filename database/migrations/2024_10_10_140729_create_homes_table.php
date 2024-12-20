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
            $table->id();
            $table->foreignId('portfolio_id')->constrained;
            $table->string('room_count'); // Oda Sayısı (ör. 2+1)
            $table->string('building_years')->nullable();// Bina yapım yılı
            $table->string('floor_level'); // Kaçıncı Kat
            $table->string('total_floors'); // Toplam Kat Sayısı
            $table->string('heating_type')->nullable(); //ısıtma tipi
            $table->string('bathroom_count')->nullable(); //ısıtma tipi
            $table->boolean('isFurnished')->default(false); // Eşyalı mı
            $table->boolean('isBalcon')->default(false); // Balkon var  mı
            $table->boolean('isElevator')->default(false); // Asansör var mı
            $table->string('parking')->nullable(); //otopark tipi
            $table->string('usage_status')->nullable(); //kullanım durumu
            $table->timestamps();
            $table->softDeletes();

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
