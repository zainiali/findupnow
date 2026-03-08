<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AboutUs extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $appends = ['header', 'header_description', 'about_us_title', 'about_us', 'why_choose_us_title', 'why_choose_desciption', 'title_one', 'description_one', 'title_two', 'description_two', 'title_three', 'description_three'];

    /**
     * @return mixed
     */
    protected function header(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->header,
        );
    }

    /**
     * @return mixed
     */
    protected function headerDescription(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->header_description,
        );
    }

    /**
     * @return mixed
     */
    protected function aboutUsTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->about_us_title,
        );
    }

    /**
     * @return mixed
     */
    protected function aboutUs(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->about_us,
        );
    }

    /**
     * @return mixed
     */
    protected function whyChooseUsTitle(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->why_choose_us_title,
        );
    }

    /**
     * @return mixed
     */
    protected function whyChooseDesciption(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->why_choose_desciption,
        );
    }

    /**
     * @return mixed
     */
    protected function titleOne(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->title_one,
        );
    }

    /**
     * @return mixed
     */
    protected function descriptionOne(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->description_one,
        );
    }

    /**
     * @return mixed
     */
    protected function titleTwo(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->title_two,
        );
    }

    /**
     * @return mixed
     */
    protected function descriptionTwo(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->description_two,
        );
    }

    /**
     * @return mixed
     */
    protected function titleThree(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->title_three,
        );
    }

    /**
     * @return mixed
     */
    protected function descriptionThree(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->description_three,
        );
    }

    /**
     * @return mixed
     */
    public function translations(): HasMany
    {
        return $this->hasMany(AboutUsTranslation::class, 'about_us_id');
    }

    /**
     * @return mixed
     */
    public function translation(): HasOne | null
    {
        return $this->hasOne(AboutUsTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation(string $code)
    {
        return $this->hasOne(AboutUsTranslation::class)->where('lang_code', $code)->first();
    }
}
