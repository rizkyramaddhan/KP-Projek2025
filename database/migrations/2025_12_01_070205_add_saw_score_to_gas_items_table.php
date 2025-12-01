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
        Schema::table('gas_items', function (Blueprint $table) {
            $table->decimal('saw_score', 8, 4)->nullable()->after('jenis');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gas_items', function (Blueprint $table) {
            $table->dropColumn('saw_score');
        });
    }
};
