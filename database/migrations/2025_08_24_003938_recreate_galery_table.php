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
        // Drop table if exists
        Schema::dropIfExists('galery');
        
        Schema::create('galery', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('cover_image')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('status')->default('public'); // public, private
            $table->timestamps();
        });
        
        // Add foreign keys separately with proper error handling
        try {
            Schema::table('galery', function (Blueprint $table) {
                if (Schema::hasTable('kategori')) {
                    $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');
                }
            });
        } catch (\Exception $e) {
            // Silently fail if foreign key cannot be created
        }
        
        try {
            Schema::table('galery', function (Blueprint $table) {
                if (Schema::hasTable('users')) {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
                }
            });
        } catch (\Exception $e) {
            // Silently fail if foreign key cannot be created
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Disable foreign key checks before dropping
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('galery');
        Schema::enableForeignKeyConstraints();
    }
};
