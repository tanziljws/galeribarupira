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
        if (!Schema::hasTable('petugas')) {
        Schema::create('petugas', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('telepon')->nullable();
            $table->timestamps();
        });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key checks before dropping
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('petugas');
        Schema::enableForeignKeyConstraints();
    }
};
