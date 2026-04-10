<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->enum('status', ['draft', 'submitted', 'reviewed', 'published'])
                  ->default('draft')
                  ->after('total_nilai'); // opsional posisi kolom
        });
    }

    public function down(): void
    {
        Schema::table('penilaians', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
