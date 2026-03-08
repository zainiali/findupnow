<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'popular_tag',
    ];

    /**
     * @var array
     */

    protected $appends = ['title', 'description', 'header_one', 'header_two', 'total_service_sold'];

    /**
     * @return mixed
     */
    public function getTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->title;
    }

    public function getDescriptionAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->description;
    }

    public function getHeaderOneAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->header_one;
    }

    public function getHeaderTwoAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->header_two;
    }

    public function getTotalServiceSoldAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->total_service_sold;
    }

    /**
     * @return mixed
     */
    public function translations()
    {
        return $this->hasMany(SliderTranslation::class, 'slider_id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->hasOne(SliderTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation($code): ?SliderTranslation
    {
        return $this->hasOne(SliderTranslation::class)->where('lang_code', $code)->first();
    }
}
