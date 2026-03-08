<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'code',
        'setting_id',
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

}
