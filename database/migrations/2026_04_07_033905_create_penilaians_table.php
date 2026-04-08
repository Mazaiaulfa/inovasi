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
    Schema::create('penilaians', function (Blueprint $table) {
    $table->id();

    // peserta
    $table->foreignId('user_id')
          ->constrained('users')
          ->cascadeOnDelete();

    // juri
    $table->foreignId('juri_id')
          ->constrained('users')
          ->cascadeOnDelete();

    $table->timestamps();

    // biar 1 juri cuma nilai 1x per peserta
    $table->unique(['user_id', 'juri_id']);
});
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
