<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('hasil_akhirs', function (Blueprint $table) {

            // kalau ada foreign key, drop dulu
            $table->dropForeign(['user_id']); // ⬅️ aman kalau ada

            // baru drop kolom
            $table->dropColumn('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('hasil_akhirs', function (Blueprint $table) {

            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        });
    }
};
