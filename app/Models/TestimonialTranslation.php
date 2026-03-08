<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestimonialTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'testimonial_id',
        'lang_code',
        'name',
        'designation',
        'comment',
    ];

    /**
     * @return mixed
     */
    public function testimonial()
    {
        return $this->belongsTo(Testimonial::class);
    }
}
