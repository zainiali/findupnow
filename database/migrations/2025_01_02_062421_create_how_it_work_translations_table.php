<?php

use App\Models\HowItWork;
use App\Models\HowItWorkTranslation;
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
        Schema::create('how_it_work_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HowItWork::class);
            $table->string('lang_code');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });

        foreach (allLanguages() as $language) {
            $aboutUs = HowItWork::all();
            foreach ($aboutUs as $aboutUsSingle) {
                $trans                 = new HowItWorkTranslation();
                $trans->how_it_work_id = $aboutUsSingle->id;
                $trans->lang_code      = $language->code;
                $trans->title          = $aboutUsSingle->title;
                $trans->description    = $aboutUsSingle->description;
                $trans->save();
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('how_it_work_translations');
    }
};
