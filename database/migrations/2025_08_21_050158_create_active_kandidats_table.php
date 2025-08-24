<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\BestStudent;
use App\Models\FieldOfficiers;
use App\Models\Sensei;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('active_kandidats', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(BestStudent::class)->nullable();
            $table->foreignIdFor(FieldOfficiers::class)->nullable();
            $table->foreignIdFor(Sensei::class)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('active_kandidats');
    }
};
