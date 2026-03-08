<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderPaymentGateway extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['key', 'value'];

    /**
     * @return mixed
     */
    public function provider()
    {
        return $this->belongsTo(User::class);
    }
}
