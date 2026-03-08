<?php

namespace Modules\CustomMenu\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Cache;

class MenuItem extends Model
{
    /**
     * @var mixed
     */
    protected $table = null;

    /**
     * @var array
     */
    protected $fillable = ['label', 'link', 'parent_id', 'sort', 'menu_id', 'custom_item', 'open_new_tab'];

    /**
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->table = 'menu_items';
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getSons($id)
    {
        return $this->where('parent_id', $id)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAll($id)
    {
        return $this->select('id', 'menu_id', 'link', 'label', 'parent_id', 'sort', 'custom_item', 'open_new_tab')->with(['translation' => function ($query) {
            $query->select('id', 'menu_item_id', 'label');
        }])->where('menu_id', $id)->orderBy('sort', 'asc')->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getAllParents($id)
    {
        return $this->with('child')->select('id', 'menu_id', 'link', 'label', 'parent_id', 'sort', 'custom_item', 'open_new_tab')->with(['translation' => function ($query) {
            $query->select('id', 'menu_item_id', 'label');
        }])->where('menu_id', $id)->where('parent_id', 0)->orderBy('sort', 'asc')->get();
    }

    /**
     * @param $menu
     */
    public static function getNextSortRoot($menu)
    {
        return self::where('menu_id', $menu)->max('sort') + 1;
    }

    /**
     * @return mixed
     */
    public function parentMenu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    /**
     * @return mixed
     */
    public function child()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('sort', 'ASC');
    }

    /**
     * @return mixed
     */
    public function getLabelAttribute(): ?string
    {
        return $this->translation->label;
    }

    /**
     * @return mixed
     */
    public function translation(): ?HasOne
    {
        return $this->hasOne(MenuItemTranslation::class, 'menu_item_id')->where('lang_code', getSessionLanguage());
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getTranslation($code): ?MenuItemTranslation
    {
        return $this->hasOne(MenuItemTranslation::class, 'menu_item_id')->where('lang_code', $code)->first();
    }

    /**
     * @return mixed
     */
    public function translations(): ?HasMany
    {
        return $this->hasMany(MenuItemTranslation::class, 'menu_item_id');
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
