<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileSliderTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'mobile_slider_id',
        'lang_code',
        'title_one',
        'title_two',
    ];

    /**
     * @return mixed
     */
    public function mobileSlider()
    {
        return $this->belongsTo(MobileSlider::class);
    }
}
