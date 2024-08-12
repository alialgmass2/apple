<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    use HasFactory, Translate, Media;
    protected $fillable = [
        'title_en',
        'title_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListAdmin($query)
    {
        return $query->select('id', toLocale('title'))->with('images')->latest();
    }
    public function scopeList($query)
    {
        return $query->select('id', toLocale('title'))->with('images');
    }

    /* ====  End of SCOPES==== */

}
