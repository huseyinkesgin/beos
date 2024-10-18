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
        Schema::create('personnel_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade'); // personel ID
            $table->string('expense_type'); // harcama türü (market, ofis vb.)
            $table->string('note'); // açıklama
            $table->decimal('amount', 10, 2); // harcama tutarı
            $table->string('payment_method'); // ödeme yöntemi
            $table->date('expense_date')- // harcama tarihi
            $table->boolean('has_receipt')->default(false); // fiş/fatura var mı
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_expenses');
    }
};
