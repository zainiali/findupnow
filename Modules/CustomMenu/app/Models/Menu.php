<?php

namespace Modules\CustomMenu\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    /**
     * @var string
     */
    protected $table = 'menus';

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = 'menus';
    }

    /**
     * @param $slug
     */
    public static function bySlug($slug)
    {
        return self::select('id', 'slug')->with(['translation' => function ($query) {
            $query->select('menu_id', 'name');
        }])->where('slug', $slug)->first();
    }

    /**
     * @param $name
     */
    public static function byName($name)
    {
        return self::where('name', '=', $name)->first();
    }

    /**
     * @return mixed
     */
    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id')->with('child')->where('parent_id', 0)->orderBy('sort', 'ASC');
    }

    /**
     * @return mixed
     */
    public function getLabelAttribute(): ?string
    {
        return $this->translation->name;
    }

    /**
     * @return mixed
     */
    public function translation(): ?HasOne
    {
        return $this->hasOne(MenuTranslation::class, 'menu_id')->where('lang_code', getSessionLanguage());
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getTranslation($code): ?MenuTranslation
    {
        return $this->hasOne(MenuTranslation::class, 'menu_id')->where('lang_code', $code)->first();
    }

    /**
     * @return mixed
     */
    public function translations(): ?HasMany
    {
        return $this->hasMany(MenuTranslation::class, 'menu_id');
    }

    public static function boot()
    {
        parent::boot();

        static::saved(function () {
            Cache::forget('nav_menu');
        });

        static::created(function () {
            Cache::forget('nav_menu');
        });

        static::updated(function () {
            Cache::forget('nav_menu');
        });

        static::deleted(function () {
            Cache::forget('nav_menu');
        });
    }
}
