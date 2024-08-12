<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TermHeader extends Model
{
    use HasFactory, Translate;

    protected $table = 'header_terms';
    protected $fillable = [
        'header_en',
        'header_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id', toLocale('title'),toLocale('sub_title'),toLocale('content'))->latest();
    }
    /* ====  End of SCOPES==== */
}
