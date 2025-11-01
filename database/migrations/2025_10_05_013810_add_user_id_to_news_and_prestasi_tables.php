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
        // Add user_id to news table
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });

        // Add user_id to prestasis table
        Schema::table('prestasis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove user_id from news table
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });

        // Remove user_id from prestasis table
        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
};
