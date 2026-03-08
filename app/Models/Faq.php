<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Faq extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $appends = ['question', 'answer'];

    /**
     * @return mixed
     */
    protected function question(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->question,
        );
    }

    protected function answer(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->answer,
        );
    }

    /**
     * @return mixed
     */
    public function translations(): HasMany
    {
        return $this->hasMany(FaqTranslation::class, 'faq_id');
    }

    /**
     * @return mixed
     */
    public function translation(): HasOne | null
    {
        return $this->hasOne(FaqTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation(string $code)
    {
        return $this->hasOne(FaqTranslation::class)->where('lang_code', $code)->first();
    }
}
