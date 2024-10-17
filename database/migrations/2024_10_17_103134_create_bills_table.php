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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // fatura türü (telefon, internet vb.)
            $table->decimal('amount', 10, 2); // tutar
            $table->date('bill_date'); //fatura tarihi
            $table->date('last_date'); //son ödeme tarihi
            $table->string('payment_method'); // ödeme yöntemi
            $table->string('bill_no'); // fatura no
            $table->boolean('is_recurring')->default(true); // düzenli fatura mı
            $table->string('status')->default('Ödenecek');
            $table->date('payment_date')->nullable(); 
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
