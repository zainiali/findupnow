<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'abcs_settings';

    /**
     * @var array
     */
    protected $appends = [
        'sidebar_lg_header',
        'sidebar_sm_header',
        'opening_time',
        'join_as_a_provider_title',
        'join_as_a_provider_btn',
        'app_short_title',
        'app_full_title',
        'app_description',
        'subscriber_title',
        'subscriber_description',
        'home2_contact_call_as',
        'home2_contact_available',
        'home2_contact_form_title',
        'home2_contact_form_description',
        'how_it_work_title',
        'how_it_work_description',
        'how_it_work_items',
    ];

    public function getSidebarLgHeaderAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->sidebar_lg_header;
    }

    public function getSidebarSmHeaderAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->sidebar_sm_header;
    }

    public function getOpeningTimeAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->opening_time;
    }

    public function getJoinAsAProviderTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->join_as_a_provider_title;
    }

    public function getJoinAsAProviderBtnAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->join_as_a_provider_btn;
    }

    public function getAppShortTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->app_short_title;
    }

    public function getAppFullTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->app_full_title;
    }

    public function getAppDescriptionAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->app_description;
    }

    public function getSubscriberTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->subscriber_title;
    }

    public function getSubscriberDescriptionAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->subscriber_description;
    }

    public function getHome2ContactCallAsAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->home2_contact_call_as;
    }

    public function getHome2ContactAvailableAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->home2_contact_available;
    }

    public function getHome2ContactFormTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->home2_contact_form_title;
    }

    public function getHome2ContactFormDescriptionAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->home2_contact_form_description;
    }

    public function getHowItWorkTitleAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->how_it_work_title;
    }

    public function getHowItWorkDescriptionAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->how_it_work_description;
    }

    public function getHowItWorkItemsAttribute(): ?string
    {
        if (!$this->relationLoaded('translation')) {
            $this->load('translation');
        }

        return optional($this->translation)->how_it_work_items;
    }

    /**
     * @return mixed
     */
    public function translations()
    {
        return $this->hasMany(SettingTranslation::class, 'setting_id');
    }

    /**
     * @return mixed
     */
    public function translation()
    {
        return $this->hasOne(SettingTranslation::class)->where('lang_code', getTranslationLangCode());
    }

    /**
     * @param  $code
     * @return mixed
     */
    public function getTranslation($code): ?SettingTranslation
    {
        return $this->hasOne(SettingTranslation::class)->where('lang_code', $code)->first();
    }
}
