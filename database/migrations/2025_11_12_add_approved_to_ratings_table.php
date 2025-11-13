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
            // Add approved column if it doesn't exist
            if (!Schema::hasColumn('ratings', 'approved')) {
                $table->boolean('approved')->default(false)->after('user_agent')->comment('Whether rating is approved to show in testimonials');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (Schema::hasColumn('ratings', 'approved')) {
                $table->dropColumn('approved');
            }
        });
    }
};
