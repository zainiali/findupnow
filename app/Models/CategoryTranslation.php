<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'lang_code',
        'category_id',
    ];

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
