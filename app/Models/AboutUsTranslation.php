<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'about_us_id',
        'lang_code',
        'header',
        'header_description',
        'about_us_title',
        'about_us',
        'why_choose_us_title',
        'why_choose_description',
        'title_one',
        'description_one',
        'title_two',
        'description_two',
        'title_three',
        'description_three',
    ];
}
