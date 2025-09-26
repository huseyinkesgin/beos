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
        Schema::table('bills', function (Blueprint $table) {
            // Önce mevcut id sütununu sil
            $table->dropColumn('id');
        });

        Schema::table('bills', function (Blueprint $table) {
            // UUID primary key ekle
            $table->uuid('id')->primary()->first();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bills', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('bills', function (Blueprint $table) {
            $table->id()->first();
        });
    }
};
