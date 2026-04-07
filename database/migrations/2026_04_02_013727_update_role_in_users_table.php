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
        Schema::table('users', function (Blueprint $table) {

            // ubah enum role
            $table->enum('role', ['admin','juri','user'])
                  ->default('user')
                  ->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // balik ke semula
            $table->enum('role', ['user','admin'])
                  ->default('user')
                  ->change();
        });
    }
};
