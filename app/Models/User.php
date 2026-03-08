<?php

namespace App\Models;

use App\Traits\NewUserCreateTrait;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable, NewUserCreateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'provider',
        'provider_id',
        'provider_avatar',
        'status',
        'email_verified',
        'phone',
        'address',
        'company_name',
        'licensed',
        'insured',
        'coverage_radius',
        'show_services_without_details',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return mixed
     */
    public function seller()
    {
        return $this->hasOne(Vendor::class);
    }

    /**
     * @return mixed
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return mixed
     */
    public function state()
    {
        return $this->belongsTo(CountryState::class);
    }

    /**
     * @return mixed
     */
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    /**
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    
    public function services()
{
    return $this->hasMany(Service::class, 'provider_id');
}

    /**
     * @return mixed
     */
    public function providerGateways()
    {
        return $this->hasMany(ProviderPaymentGateway::class, 'user_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function ($user) {
            if ($user->is_provider == 1) {
                self::addProviderGateways($user);
            }

            try {
                if (!$user->user_name) {
                    $user->user_name = str($user->name)->slug();
                    $user->save();
                }
            } catch (Exception $e) {
                logger()->error($e->getMessage());
            }
        });
    }

}
