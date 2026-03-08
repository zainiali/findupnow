<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionContentTranslation extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = [
        'section_content_id',
        'lang_code',
        'title',
        'description',
    ];

    /**
     * @return mixed
     */
    public function sectionContent()
    {
        return $this->belongsTo(SectionContent::class, 'section_content_id', 'id');
    }
}
