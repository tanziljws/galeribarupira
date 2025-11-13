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
        // Only add columns if table exists
        if (Schema::hasTable('suggestions')) {
            Schema::table('suggestions', function (Blueprint $table) {
                // Add columns for rating integration - only if they don't exist
                if (!Schema::hasColumn('suggestions', 'tipe')) {
                    $table->string('tipe')->default('suggestion')->after('pesan')->comment('Type: suggestion or rating');
                }
                if (!Schema::hasColumn('suggestions', 'rating_value')) {
                    $table->integer('rating_value')->nullable()->after('tipe')->comment('Rating value 1-5');
                }
                if (!Schema::hasColumn('suggestions', 'user_ip')) {
                    $table->string('user_ip')->nullable()->after('rating_value')->comment('User IP address');
                }
                if (!Schema::hasColumn('suggestions', 'user_agent')) {
                    $table->text('user_agent')->nullable()->after('user_ip')->comment('User browser info');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Only drop columns if table exists
        if (Schema::hasTable('suggestions')) {
            Schema::table('suggestions', function (Blueprint $table) {
                $columnsToDelete = [];
                if (Schema::hasColumn('suggestions', 'tipe')) {
                    $columnsToDelete[] = 'tipe';
                }
                if (Schema::hasColumn('suggestions', 'rating_value')) {
                    $columnsToDelete[] = 'rating_value';
                }
                if (Schema::hasColumn('suggestions', 'user_ip')) {
                    $columnsToDelete[] = 'user_ip';
                }
                if (Schema::hasColumn('suggestions', 'user_agent')) {
                    $columnsToDelete[] = 'user_agent';
                }
                if (!empty($columnsToDelete)) {
                    $table->dropColumn($columnsToDelete);
                }
            });
        }
    }
};
