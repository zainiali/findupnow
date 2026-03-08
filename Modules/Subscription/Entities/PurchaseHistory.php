<?php

namespace Modules\Subscription\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PurchaseHistory extends Model
{
    /**
     * @var array
     */
    protected $fillable = [];

    /**
     * @return mixed
     */
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
}
