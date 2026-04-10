<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('penilaians', function (Blueprint $table) {
        $table->integer('total_nilai')->nullable()->after('juri_id');
    });
}

public function down()
{
    Schema::table('penilaians', function (Blueprint $table) {
        $table->dropColumn('total_nilai');
    });
    }
};
