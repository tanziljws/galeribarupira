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
        Schema::table('galery', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('galery', 'nama')) {
                $table->string('nama')->after('id');
            }
            if (!Schema::hasColumn('galery', 'deskripsi')) {
                $table->text('deskripsi')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('galery', 'cover_image')) {
                $table->string('cover_image')->nullable()->after('deskripsi');
            }
            if (!Schema::hasColumn('galery', 'kategori_id')) {
                $table->foreignId('kategori_id')->nullable()->after('cover_image')->constrained('kategori')->onDelete('set null');
            }
            if (!Schema::hasColumn('galery', 'user_id')) {
                $table->foreignId('user_id')->nullable()->after('kategori_id')->constrained('users')->onDelete('set null');
            }
            if (!Schema::hasColumn('galery', 'status')) {
                $table->string('status')->default('public')->after('user_id');
            }
            if (!Schema::hasColumn('galery', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galery', function (Blueprint $table) {
            $table->dropColumn(['nama', 'deskripsi', 'cover_image', 'kategori_id', 'user_id', 'status', 'created_at', 'updated_at']);
        });
    }
};
