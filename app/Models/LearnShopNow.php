<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearnShopNow extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'text_en',
        'text_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id', toLocale('text'));
    }

    /* ====  End of SCOPES==== */
}
