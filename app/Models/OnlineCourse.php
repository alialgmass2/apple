<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineCourse extends Model
{

    use HasFactory, Translate, Media;

    protected $fillable = [
        'title_en',
        'title_ar',
        'title_2_en',
        'title_2_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListAdmin($query)
    {
        return $query->select('id', toLocale('title'), toLocale('title_2'))->with('images')->latest();
    }

    public function scopeList($query)
    {
        return $query->select('id', toLocale('title'), toLocale('title_2'))->with('images');
    }

    /* ====  End of SCOPES==== */


}
