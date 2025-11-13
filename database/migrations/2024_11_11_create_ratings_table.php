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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('rating')->comment('Rating value 1-5');
            $table->string('page')->default('beranda')->comment('Page where rating was submitted');
            $table->string('user_ip')->nullable()->comment('User IP address');
            $table->text('user_agent')->nullable()->comment('User browser info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
