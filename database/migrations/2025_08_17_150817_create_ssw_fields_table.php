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
        Schema::create('ssw_fields', function (Blueprint $table) {
            $table->id();
            $table->string('image_icon');
            $table->string('title');
            $table->string('subtitle_japan')->nullable();
            $table->string('desc');
            $table->string('jumlah_dibutuhkan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ssw_fields');
    }
};
