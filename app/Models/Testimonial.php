<?php

namespace App\Models;

use App\Interfaces\HasTranslationsInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Testimonial extends Model implements HasTranslationsInterface
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['status'];

    /**
     * @var array
     */
    protected $with = ['translation'];

    /**
     * @var array
     */
    protected $appends = ['name', 'designation', 'comment'];

    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)->name,
        );
    }

    protected function designation(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)->designation,
        );
    }

    protected function comment(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)->comment,
        );
    }

    /**
     * @return mixed
     */
    public function translations(): HasMany
    {
        return $this->hasMany(TestimonialTranslation::class, 'testimonial_id');
    }

    /**
     * @return mixed
     */
    public function translation(): HasOne | null
    {
        return $this->hasOne(TestimonialTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation($code)
    {
        return $this->hasOne(TestimonialTranslation::class, 'testimonial_id')->where('lang_code', $code)->first();
    }
}
