<?php

namespace App\Models;

use App\Interfaces\HasTranslationsInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Counter extends Model implements HasTranslationsInterface
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['status', 'number'];

    /**
     * @var array
     */
    protected $appends = ['title'];

    protected function title(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)->title,
        );
    }

    /**
     * @return mixed
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CounterTranslation::class, 'counter_id');
    }

    /**
     * @return mixed
     */
    public function translation(): HasOne | null
    {
        return $this->hasOne(CounterTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation(string $code)
    {
        return $this->hasOne(CounterTranslation::class)->where('lang_code', $code)->first();
    }
}
