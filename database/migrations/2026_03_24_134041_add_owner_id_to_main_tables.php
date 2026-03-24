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
        Schema::table('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable()->after('user_id')->index();
        });

        Schema::table('alvaras', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id')->nullable()->after('user_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });

        Schema::table('alvaras', function (Blueprint $table) {
            $table->dropColumn('owner_id');
        });
    }
};
