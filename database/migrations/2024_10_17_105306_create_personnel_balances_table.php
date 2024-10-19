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
        Schema::create('personnel_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade'); // personel ID
            $table->decimal('cash_in', 10, 2)->nullable(); // Nakit giriş
            $table->decimal('cash_out', 10, 2)->nullable(); // Nakit çıkış
            $table->decimal('balance', 10, 2)->default(0); // Otomatik hesaplanan bakiye
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_balances');
    }
};
