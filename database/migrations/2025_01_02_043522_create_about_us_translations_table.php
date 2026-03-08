<?php

use App\Models\AboutUs;
use App\Models\AboutUsTranslation;
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
        Schema::create('about_us_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(AboutUs::class);
            $table->string('lang_code');
            $table->string('header')->nullable();
            $table->text('header_description')->nullable();
            $table->string('about_us_title')->nullable();
            $table->text('about_us')->nullable();
            $table->string('why_choose_us_title')->nullable();
            $table->text('why_choose_desciption')->nullable();
            $table->string('title_one')->nullable();
            $table->text('description_one')->nullable();
            $table->string('title_two')->nullable();
            $table->text('description_two')->nullable();
            $table->string('title_three')->nullable();
            $table->text('description_three')->nullable();
            $table->timestamps();
        });

        foreach (allLanguages() as $language) {
            $aboutUs = AboutUs::first();
            if ($aboutUs) {
                $trans                        = new AboutUsTranslation();
                $trans->about_us_id           = $aboutUs->id;
                $trans->lang_code             = $language->code;
                $trans->header                = $aboutUs->header;
                $trans->header_description    = $aboutUs->header_description;
                $trans->about_us_title        = $aboutUs->about_us_title;
                $trans->about_us              = $aboutUs->about_us;
                $trans->why_choose_us_title   = $aboutUs->why_choose_us_title;
                $trans->why_choose_desciption = $aboutUs->why_choose_desciption;
                $trans->title_one             = $aboutUs->title_one;
                $trans->description_one       = $aboutUs->description_one;
                $trans->title_two             = $aboutUs->title_two;
                $trans->description_two       = $aboutUs->description_two;
                $trans->title_three           = $aboutUs->title_three;
                $trans->description_three     = $aboutUs->description_three;
                $trans->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us_translations');
    }
};
