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
        Schema::dropIfExists('foto');
        
        Schema::create('foto', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('file_path');
            $table->string('file_name');
            $table->string('file_size');
            $table->string('file_type');
            $table->string('thumbnail_path')->nullable();
            $table->unsignedBigInteger('galery_id')->nullable();
            $table->unsignedBigInteger('kategori_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
        });
        
        // Add foreign keys separately with error handling
        try {
            Schema::table('foto', function (Blueprint $table) {
                if (Schema::hasTable('galery')) {
                    $table->foreign('galery_id')->references('id')->on('galery')->onDelete('cascade');
                }
            });
        } catch (\Exception $e) {
            // Silently fail if foreign key cannot be created
        }
        
        try {
            Schema::table('foto', function (Blueprint $table) {
                if (Schema::hasTable('kategori')) {
                    $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('set null');
                }
            });
        } catch (\Exception $e) {
            // Silently fail if foreign key cannot be created
        }
        
        try {
            Schema::table('foto', function (Blueprint $table) {
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
        Schema::dropIfExists('foto');
        Schema::enableForeignKeyConstraints();
    }
};
