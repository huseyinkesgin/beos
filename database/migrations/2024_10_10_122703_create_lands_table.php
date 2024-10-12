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
            $table->id();
            $table->foreignId('portfolio_id')->constrained;

            $table->string('area_m2'); // m²
            $table->string('zoning_status'); // İmar Durumu
            $table->string('similar')->nullable(); // Emsal
            $table->string('height_limit')->nullable(); // Gabari
            $table->timestamps(); // Timestamps ekleyin

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
