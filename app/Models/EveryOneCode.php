<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EveryOneCode extends Model
{

    use HasFactory, Translate, Media;

    protected $fillable = [
        'title_en',
        'title_ar',
        'text_en',
        'text_ar',
        'url',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListAdmin($query)
    {
        return $query->select('id', toLocale('title'), toLocale('text'),'url')->with('images')->latest();
    }
    public function scopeList($query)
    {
        return $query->select('id', toLocale('title'), toLocale('text'),'url')->with('images');
    }

    /* ====  End of SCOPES==== */


}
