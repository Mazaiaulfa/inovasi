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
    Schema::table('penilaians', function (Blueprint $table) {
        $table->string('apresiasi')->nullable()->after('total_nilai');
    });
}

public function down(): void
{
    Schema::table('penilaians', function (Blueprint $table) {
        $table->dropColumn('apresiasi');
    });
}
    
};
