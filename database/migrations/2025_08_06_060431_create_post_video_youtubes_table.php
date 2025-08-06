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
        Schema::create('post_video_youtubes', function (Blueprint $table) {
            $table->id();
            $table->string('thumbnail');
            $table->string('url_video');
            $table->string('title');
            $table->text('desc');
            $table->text('location')->nullable();
            $table->string('category');
            $table->string('tag')->nullable();
            $table->string('duration')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_video_youtubes');
    }
};
