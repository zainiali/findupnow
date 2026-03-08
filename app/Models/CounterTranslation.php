<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['title'];

    /**
     * @return mixed
     */
    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
