<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentIntro extends Model
{
    use HasFactory,Translate;
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
        return $query->select('id',toLocale('title'),toLocale('text'))->latest();
    }

    /* ====  End of SCOPES==== */
}
