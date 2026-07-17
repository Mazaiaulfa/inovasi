<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('juri_peserta', function (Blueprint $table) {
            $table->enum('stream', ['Stream 1', 'Stream 2'])
                  ->default('Stream 1')
                  ->after('peserta_id');
        });
    }

    public function down(): void
    {
        Schema::table('juri_peserta', function (Blueprint $table) {
            $table->dropColumn('stream');
        });
    }
};
