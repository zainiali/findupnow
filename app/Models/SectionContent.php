<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContent extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['section_name'];

    /**
     * @var array
     */
    protected $appends = ['title', 'description'];

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

    /**
     * @return mixed
     */
    public function getDescriptionAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->description;
    }

    /**
     * @return mixed
     */
    public function translations()
    {
        return $this->hasMany(SectionContentTranslation::class, 'section_content_id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->hasOne(SectionContentTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation($code): ?SectionContentTranslation
    {
        return $this->hasOne(SectionContentTranslation::class)->where('lang_code', $code)->first();
    }
}
