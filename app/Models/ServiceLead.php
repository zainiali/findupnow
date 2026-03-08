<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceLead extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'category_id',
        'service_type',
        'zip_code',
        'location_city',
        'location_state',
        'location_country',
        'full_address',
        'additional_details',
        'customer_name',
        'customer_email',
        'customer_phone',
        'status',
        'matched_provider_ids',
        'views_count',
        'last_viewed_at',
    ];

    protected $casts = [
        'matched_provider_ids' => 'array',
        'last_viewed_at' => 'datetime',
    ];

    /**
     * Generate unique lead ID on creation
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($lead) {
            if (empty($lead->lead_id)) {
                $lead->lead_id = 'LEAD-' . strtoupper(uniqid());
            }
        });
    }

    /**
     * Get the category this lead belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get providers who have viewed this lead
     */
    public function viewedByProviders()
    {
        return $this->belongsToMany(User::class, 'service_lead_views', 'lead_id', 'provider_id')
            ->withPivot('viewed_at');
    }

    /**
     * Check if a provider has viewed this lead
     */
    public function hasBeenViewedBy($providerId)
    {
        return $this->viewedByProviders()->where('users.id', $providerId)->exists();
    }

    /**
     * Mark lead as viewed by a provider
     */
    public function markAsViewedBy($providerId)
    {
        if (!$this->hasBeenViewedBy($providerId)) {
            $this->viewedByProviders()->attach($providerId, ['viewed_at' => now()]);
            $this->increment('views_count');
            $this->update(['last_viewed_at' => now()]);
        }
    }

    /**
     * Check if a specific provider is matched to this lead
     */
    public function isMatchedToProvider($providerId)
    {
        if (empty($this->matched_provider_ids)) {
            return false;
        }
        
        return in_array($providerId, $this->matched_provider_ids);
    }

    /**
     * Scope: Get leads visible to a specific provider
     */
    public function scopeForProvider($query, $providerId)
    {
        return $query->whereJsonContains('matched_provider_ids', $providerId);
    }

    /**
     * Scope: Get new leads
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope: Get contacted leads
     */
    public function scopeContacted($query)
    {
        return $query->where('status', 'contacted');
    }

    /**
     * Get Bootstrap badge class for status
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'new' => 'badge-success',
            'contacted' => 'badge-info',
            'converted' => 'badge-primary',
            'closed' => 'badge-secondary',
        ];

        return $badges[$this->status] ?? 'badge-secondary';
    }

    /**
     * Get human-readable formatted status
     */
    public function getFormattedStatusAttribute()
    {
        return ucfirst(str_replace('_', ' ', $this->status));
    }
}