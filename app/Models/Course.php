<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, Translate, Media;
    protected $fillable = [
        'education_level_id',
        'title_en',
        'title_ar',
        'estimated_time',
        'brief_en',
        'brief_ar',
        'what_will_learn_en',
        'what_will_learn_ar',
        'content_en',
        'content_ar',
        'requirements_en',
        'requirements_ar',
        'description_en',
        'description_ar',
        'about_en',
        'about_ar',
        'url',
    ];

    public function scopeListAdmin($query)
    {
        return $query->select('id','education_level_id',toLocale('title'),'estimated_time')->with('images','educationLevel')->latest();
    }
    public function scopeList($query)
    {
        return $query->select('id','url',toLocale('title'),toLocale('brief'))->with('images')->latest();
    }
    public function scopeDetails($query,$courseId)
    {
        return $query->select('id','education_level_id','estimated_time',toLocale('title'),toLocale('brief'),toLocale('what_will_learn'),toLocale('content'),toLocale('requirements'),
        toLocale('description'),toLocale('about'))->where('id',$courseId)
        ->with('images');
    }

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class)->withDefault();
    }

    /* ====  End of REALTIONS==== */
}
