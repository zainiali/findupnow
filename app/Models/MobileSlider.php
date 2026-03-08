<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileSlider extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['status', 'serial'];

    /**
     * @var array
     */
    protected $appends = ['title_one', 'title_two'];

    public function getTitleOneAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->title_one;
    }

    public function getTitleTwoAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->title_two;
    }

    /**
     * @return mixed
     */
    public function translations()
    {
        return $this->hasMany(MobileSliderTranslation::class, 'mobile_slider_id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->hasOne(MobileSliderTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation($code): ?MobileSliderTranslation
    {
        return $this->hasOne(MobileSliderTranslation::class)->where('lang_code', $code)->first();
    }
}
