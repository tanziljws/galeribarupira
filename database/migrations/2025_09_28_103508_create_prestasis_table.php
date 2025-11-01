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
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content');
            $table->string('image_path')->nullable();
            $table->string('achievement_type'); // 'akademik', 'non_akademik', 'olahraga', 'seni', 'lainnya'
            $table->string('level'); // 'sekolah', 'kota', 'provinsi', 'nasional', 'internasional'
            $table->string('year');
            $table->string('participant_name')->nullable(); // nama siswa/kelompok
            $table->string('teacher_name')->nullable(); // nama pembimbing
            $table->string('position')->nullable(); // juara 1, 2, 3, dll
            $table->string('organizer')->nullable(); // penyelenggara
            $table->string('location')->nullable(); // lokasi
            $table->date('achievement_date')->nullable();
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
