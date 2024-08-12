<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EveryOneCreate extends Model
{

    use HasFactory, Translate, Media;

    protected $fillable = [
        'text_en',
        'text_ar',
        // 'text_2_en',
        // 'text_2_ar',
        'findout_link',
        'download_link',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListAdmin($query)
    {
        return $query->select('id', toLocale('text'), 'findout_link','download_link')->with('images')->latest();
    }

    /* ====  End of SCOPES==== */


}
