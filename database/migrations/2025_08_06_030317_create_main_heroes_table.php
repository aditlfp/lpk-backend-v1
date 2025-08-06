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
        Schema::create('main_heroes', function (Blueprint $table) {
            $table->id();
            $table->string('c_image');
            $table->string('main_logo');
            $table->string('text_logo');
            $table->string('title');
            $table->text('desc')->nullable();
            $table->string('collab_logo')->nullable();
            $table->boolean('is_pinned')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('main_heroes');
    }
};
