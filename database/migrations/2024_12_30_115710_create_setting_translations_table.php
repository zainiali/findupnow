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
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('setting_id');
            $table->string('lang_code');
            $table->string('sidebar_lg_header')->nullable();
            $table->string('sidebar_sm_header')->nullable();
            $table->string('opening_time')->nullable();
            $table->string('join_as_a_provider_title')->nullable();
            $table->string('join_as_a_provider_btn')->nullable();
            $table->string('app_short_title')->nullable();
            $table->string('app_full_title')->nullable();
            $table->text('app_description')->nullable();
            $table->string('subscriber_title')->nullable();
            $table->text('subscriber_description')->nullable();
            $table->string('home2_contact_call_as')->nullable();
            $table->string('home2_contact_available')->nullable();
            $table->string('home2_contact_form_title')->nullable();
            $table->text('home2_contact_form_description')->nullable();
            $table->string('how_it_work_title')->nullable();
            $table->text('how_it_work_description')->nullable();
            $table->text('how_it_work_items')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_translations');
    }
};
