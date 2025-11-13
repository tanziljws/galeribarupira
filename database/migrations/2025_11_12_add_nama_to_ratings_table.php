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
        Schema::table('ratings', function (Blueprint $table) {
            // Add nama column after rating if it doesn't exist
            if (!Schema::hasColumn('ratings', 'nama')) {
                $table->string('nama')->default('Anonymous')->after('rating')->comment('User name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (Schema::hasColumn('ratings', 'nama')) {
                $table->dropColumn('nama');
            }
        });
    }
};
