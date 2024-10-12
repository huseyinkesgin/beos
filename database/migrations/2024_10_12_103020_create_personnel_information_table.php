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
        Schema::create('personnel_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personnel_id')->constrained('personnels')->onDelete('cascade');
            $table->string('identity_number')->unique(); // TC kimlik numarası
            $table->string('driving_license_number')->nullable(); // Ehliyet numarası
            $table->date('birth_date')->nullable();
            $table->string('photo')->nullable(); // Fotoğraf dosya yolu
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personnel_information');
    }
};
