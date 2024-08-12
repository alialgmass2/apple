<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
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
        return $query->select('id',toLocale('title'),toLocale('text'))->with('images');
    }
    public function scopeListAdmin($query)
    {
        return $query->select('id',toLocale('title'),toLocale('text'))->with('images')->latest();
    }

    /* ====  End of SCOPES==== */

}
