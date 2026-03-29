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
    Schema::table('pengumuman', function (Blueprint $table) {
        // hapus kolom yang nggak dipakai
        $table->dropColumn(['tanggal_mulai', 'tanggal_selesai', 'urgent']);

        // tambah kolom urutan
        $table->integer('urutan')->default(0)->after('gambar');
    });
}

public function down(): void
{
    Schema::table('pengumuman', function (Blueprint $table) {
        // balikin lagi kalau rollback
        $table->date('tanggal_mulai');
        $table->date('tanggal_selesai')->nullable();
        $table->boolean('urgent')->default(false);

        // hapus urutan
        $table->dropColumn('urutan');
    });
}
};
