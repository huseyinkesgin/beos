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
        Schema::create('overal_expenses', function (Blueprint $table) {
            $table->id();
            $table->string('expense_type'); // Gider türü (fatura veya personel harcaması)
            $table->decimal('amount', 10, 2); // Toplam gider
            $table->date('expense_date'); // Harcama tarihi
            $table->string('source')->nullable(); // Kaynak (fatura türü veya personel adı)
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overal_expenses');
    }
};
