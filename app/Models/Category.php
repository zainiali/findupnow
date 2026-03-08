<?php

namespace App\Models;

use App\Interfaces\HasTranslationsInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Category extends Model implements HasTranslationsInterface
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['slug', 'status'];

    /**
     * @var array
     */
    protected $appends = ['totalService', 'name'];

    /**
     * @return mixed
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn() => optional($this->loadMissing('translation')->translation)?->name,
        );
    }

    /**
     * @return mixed
     */
    public function getTotalServiceAttribute()
    {
        // Check if the service count is already loaded
        if ($this->relationLoaded('service')) {
            // Return the count from the loaded relationship
            return $this->service->count();
        }

        // Check if the count is preloaded using `withCount`
        if (array_key_exists('service_count', $this->getAttributes())) {
            return $this->service_count;
        }

        // Otherwise, load the count dynamically
        return $this->service()->count();
    }

    /**
     * @return mixed
     */
    public function service()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * @return mixed
     */
    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class, 'category_id');
    }

    /**
     * @return mixed
     */
    public function translation(): HasOne | null
    {
        return $this->hasOne(CategoryTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation(string $code)
    {
        return $this->hasOne(CategoryTranslation::class)->where('lang_code', $code)->first();
    }

}
