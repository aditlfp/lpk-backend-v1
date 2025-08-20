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
        Schema::create('lpk_classes', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('title');
            $table->text('desc');
            $table->string('waktu_pendidikan')->default("0 Bulan Pendidikan");
            $table->boolean('bersertifikat')->default(0);
            $table->string('url');
            $table->boolean('active')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lpk_classes');
    }
};
