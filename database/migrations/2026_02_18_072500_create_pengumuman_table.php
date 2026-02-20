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
        Schema::create('pengumuman', function (Blueprint $table) {
    $table->id();
    $table->string('judul');
    $table->text('ringkasan')->nullable();
    $table->longText('isi');
    $table->string('gambar')->nullable();
    $table->boolean('urgent')->default(false);
    $table->boolean('is_active')->default(true);
    $table->date('tanggal_mulai');
    $table->date('tanggal_selesai')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengumuman');
    }
};
