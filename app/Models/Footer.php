<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $appends = ['about_us', 'address', 'copyright'];

    public function getAboutUsAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->about_us;
    }

    public function getAddressAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->address;
    }

    public function getCopyrightAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->copyright;
    }

    /**
     * @return mixed
     */
    public function translations()
    {
        return $this->hasMany(FooterTranslation::class, 'footer_id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->hasOne(FooterTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation($code): ?FooterTranslation
    {
        return $this->hasOne(FooterTranslation::class)->where('lang_code', $code)->first();
    }

}
