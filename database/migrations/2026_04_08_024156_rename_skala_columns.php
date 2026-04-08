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
    Schema::table('kriterias', function (Blueprint $table) {
    $table->renameColumn('skala_1-4', 'skala_1_4');
    $table->renameColumn('skala_5-6', 'skala_5_6');
    $table->renameColumn('skala_7-8', 'skala_7_8');
    $table->renameColumn('skala_9-10', 'skala_9_10');
});
    }

    /**
     * Reverse the migrations.
     */
   public function down(): void
{
    Schema::table('kriterias', function (Blueprint $table) {
        $table->renameColumn('skala_1_4', 'skala_1-4');
        $table->renameColumn('skala_5_6', 'skala_5-6');
        $table->renameColumn('skala_7_8', 'skala_7-8');
        $table->renameColumn('skala_9_10', 'skala_9-10');
    });
}
};
