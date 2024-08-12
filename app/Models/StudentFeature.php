<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentFeature extends Model
{

    use HasFactory, Translate, Media;

    protected $fillable = [
        'title_en',
        'title_ar',
        'text_en',
        'text_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id', toLocale('text'), toLocale('title'))->with('images');
    }

    public function scopeListAdmin($query)
    {
        return $query->select('id', toLocale('text'), toLocale('title'))->with('images')->orderByDesc('id');
    }

    /* ====  End of SCOPES==== */

}
