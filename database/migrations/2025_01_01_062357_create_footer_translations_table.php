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
        Schema::create('footer_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('footer_id');
            $table->string('lang_code');
            $table->string('about_us')->nullable();
            $table->string('address')->nullable();
            $table->string('copyright')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footer_translations');
    }
};
