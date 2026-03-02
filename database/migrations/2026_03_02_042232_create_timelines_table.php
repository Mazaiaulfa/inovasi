<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->string('judul');           // Nama kegiatan / tahapan
            $table->text('deskripsi')->nullable(); // Deskripsi singkat
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('urutan')->default(1); // Untuk sorting di timeline
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
