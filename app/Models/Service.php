<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    public function getConvertedPriceAttribute()
    {
        return convertToCurrencyAmount($this->price);
    }

    /**
     * @return mixed
     */
    public function category()
    {
        return $this->belongsTo(Category::class)->select('id', 'icon', 'slug')->with('translation');
    }

    /**
     * @return mixed
     */
    public function provider()
    {
        return $this->belongsTo(User::class)->select('id', 'name', 'email', 'phone', 'image', 'created_at', 'user_name', 'kyc_status');
    }

    /**
     * @return mixed
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return mixed
     */
    public function activeReviews()
    {
        return $this->hasMany(Review::class, 'service_id')->where('status', 1);
    }

    /**
     * @var array
     */
    protected $appends = ['averageRating', 'totalReview', 'totalOrder', 'converted_price'];

    /**
     * @return mixed
     */
    public function getAverageRatingAttribute()
    {
        return $this->activeReviews()->avg('rating') ?: '0';
    }

    /**
     * @return mixed
     */
    public function getTotalReviewAttribute()
    {
        return $this->activeReviews()->count();
    }

    /**
     * @return mixed
     */
    public function getTotalOrderAttribute()
    {
        return $this->orders()->count();
    }

    /**
     * @return mixed
     */
    public function serviceAreas()
    {
        return $this->hasMany(ServiceArea::class, 'provider_id', 'provider_id');
    }

}
