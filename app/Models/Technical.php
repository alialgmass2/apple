<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technical extends Model
{
    use HasFactory, Translate, Media;
    protected $fillable = [
        'text_en',
        'text_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id', toLocale( 'text'))->with('images')->latest();
    }

    /* ====  End of SCOPES==== */
}