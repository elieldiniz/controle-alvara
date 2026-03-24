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
        Schema::table('alvaras', function (Blueprint $table) {
            $table->foreignId('tipo_alvara_id')->nullable()->after('user_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alvaras', function (Blueprint $table) {
            $table->dropForeign(['tipo_alvara_id']);
            $table->dropColumn('tipo_alvara_id');
        });
    }
};
