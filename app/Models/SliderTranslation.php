<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'slider_id',
        'lang_code',
        'title',
        'description',
        'header_one',
        'header_two',
        'total_service_sold',
    ];

    /**
     * @return mixed
     */
    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
