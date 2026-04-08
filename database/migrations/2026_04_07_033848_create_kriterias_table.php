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
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();

            $table->string('item');        // PLAN, DO, dll
            $table->integer('no');
            $table->string('nama');

            $table->text('keterangan')->nullable();
            $table->string('rujukan')->nullable();

            // skala penilaian
            $table->text('skala_1-4')->nullable(); // 1-4
            $table->text('skala_5-6')->nullable(); // 5-6
            $table->text('skala_7-8')->nullable(); // 7-8
            $table->text('skala_9-10')->nullable(); // 9-10
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriterias');
    }
};
