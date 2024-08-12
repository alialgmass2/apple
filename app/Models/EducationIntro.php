<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationIntro extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'text_en',
        'text_ar',
        'url',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id', toLocale('text'), 'url')->latest();
    }

    /* ====  End of SCOPES==== */
}
