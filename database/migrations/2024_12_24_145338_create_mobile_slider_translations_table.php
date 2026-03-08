<?php

use App\Models\MobileSlider;
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
        Schema::create('mobile_slider_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MobileSlider::class);
            $table->string('lang_code');
            $table->string('title_one')->nullable();
            $table->string('title_two')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobile_slider_translations');
    }
};
