<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penilaian_details', function (Blueprint $table) {
            $table->id();

            // relasi ke penilaian (WAJIB)
            $table->foreignId('penilaian_id')
                ->constrained('penilaians')
                ->cascadeOnDelete();

            // relasi ke kriteria
            $table->foreignId('kriteria_id')
                ->constrained('kriterias')
                ->cascadeOnDelete();

            $table->integer('nilai')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penilaian_details');
    }
};
