<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Step 1: ubah definisi enum kolom jabatan dulu
        Schema::table('anggota', function (Blueprint $table) {
            $table->enum('jabatan', ['ketua', 'verifikator', 'fasilitator', 'sekretaris', 'anggota'])
                ->default('anggota')
                ->change();
        });

        // Step 2: baru update data dari verifikator → fasilitator
        DB::table('anggota')
            ->where('jabatan', 'verifikator')
            ->update(['jabatan' => 'fasilitator']);

        // Step 3: drop enum lama (hapus 'verifikator')
        Schema::table('anggota', function (Blueprint $table) {
            $table->enum('jabatan', ['ketua', 'fasilitator', 'sekretaris', 'anggota'])
                ->default('anggota')
                ->change();
        });
    }

    public function down(): void
    {
        // Step 1: tambahkan dulu enum lama kembali (masukkan verifikator lagi)
        Schema::table('anggota', function (Blueprint $table) {
            $table->enum('jabatan', ['ketua', 'fasilitator', 'verifikator', 'sekretaris', 'anggota'])
                ->default('anggota')
                ->change();
        });

        // Step 2: kembalikan data fasilitator → verifikator
        DB::table('anggota')
            ->where('jabatan', 'fasilitator')
            ->update(['jabatan' => 'verifikator']);

        // Step 3: hapus fasilitator dari enum
        Schema::table('anggota', function (Blueprint $table) {
            $table->enum('jabatan', ['ketua', 'verifikator', 'sekretaris', 'anggota'])
                ->default('anggota')
                ->change();
        });
    }
};
