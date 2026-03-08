<?php

use App\Models\TermsAndCondition;
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
        Schema::create('terms_and_condition_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TermsAndCondition::class);
            $table->string('lang_code');
            $table->longText('terms_and_condition')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms_and_condition_translations');
    }
};
