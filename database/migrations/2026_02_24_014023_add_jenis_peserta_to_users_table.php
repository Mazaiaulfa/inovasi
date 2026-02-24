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
    Schema::table('users', function (Blueprint $table) {
        $table->enum('jenis_peserta', ['EIF', 'GKM'])->after('role');
        $table->string('nama_tim')->nullable()->after('jenis_peserta');
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('jenis_peserta');
        $table->dropColumn('nama_tim');
    });
}
};
