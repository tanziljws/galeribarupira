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
        Schema::table('petugas', function (Blueprint $table) {
            if (!Schema::hasColumn('petugas', 'nama')) {
                $table->string('nama')->after('password');
            }
            if (!Schema::hasColumn('petugas', 'email')) {
                $table->string('email')->nullable()->after('nama');
            }
            if (!Schema::hasColumn('petugas', 'jabatan')) {
                $table->string('jabatan')->nullable()->after('email');
            }
            if (!Schema::hasColumn('petugas', 'telepon')) {
                $table->string('telepon')->nullable()->after('jabatan');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('petugas', function (Blueprint $table) {
            if (Schema::hasColumn('petugas', 'telepon')) {
                $table->dropColumn('telepon');
            }
            if (Schema::hasColumn('petugas', 'jabatan')) {
                $table->dropColumn('jabatan');
            }
            if (Schema::hasColumn('petugas', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('petugas', 'nama')) {
                $table->dropColumn('nama');
            }
        });
    }
};
