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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_type')->default('Bireysel');
            $table->string('category');// mal sahibi, emlakçı, komisyoncu, referans,alıcı
            $table->string('name');
            $table->string('company_name')->nullable();
            $table->string('tax_office')->nullable();
            $table->string('tax_no')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('company')->nullable();
            $table->string('address')->nullable();
            $table->boolean('isActive')->default(true); // BaseModel'den gelen aktiflik alanı
            $table->text('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
