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
        Schema::table('kategori', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('kategori', 'nama')) {
                $table->string('nama')->after('id');
            }
            if (!Schema::hasColumn('kategori', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('kategori', 'slug')) {
                $table->string('slug')->unique()->after('deskripsi');
            }
            if (!Schema::hasColumn('kategori', 'icon')) {
                $table->string('icon')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('kategori', 'color')) {
                $table->string('color')->default('#3B82F6')->after('icon');
            }
            if (!Schema::hasColumn('kategori', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kategori', function (Blueprint $table) {
            $table->dropColumn(['nama', 'deskripsi', 'slug', 'icon', 'color', 'created_at', 'updated_at']);
        });
    }
};
