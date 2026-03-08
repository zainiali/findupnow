<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TermsAndCondition extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $appends = [
        'terms_and_condition',
        'privacy_policy',
    ];

    /**
     * @return mixed
     */
    protected function termsAndCondition(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->terms_and_condition,
        );
    }

    /**
     * @return mixed
     */
    protected function privacyPolicy(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->privacy_policy,
        );
    }

    /**
     * @return mixed
     */
    public function translations(): HasMany
    {
        return $this->hasMany(TermsAndConditionTranslation::class, 'terms_and_condition_id');
    }

    /**
     * @return mixed
     */
    public function translation(): HasOne | null
    {
        return $this->hasOne(TermsAndConditionTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation(string $code)
    {
        return $this->hasOne(TermsAndConditionTranslation::class)->where('lang_code', $code)->first();
    }
}
