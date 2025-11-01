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
        Schema::create('gallery_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('foto_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('activity_type'); // like, comment, report, view
            $table->text('content')->nullable(); // untuk comment atau report message
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->index('foto_id');
            $table->index('user_id');
            $table->index('activity_type');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gallery_activities');
    }
};
