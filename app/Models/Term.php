<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory, Translate;

    protected $table = 'terms';
    protected $fillable = [
        'title_en',
        'title_ar',
        'sub_title_en',
        'sub_title_ar',
        'content_ar',
        'content_en',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id','created_at', toLocale('title'),toLocale('sub_title'),toLocale('content'))->latest();
    }
    protected $casts = [
        'content_ar' =>'array',
        'content_en' =>'array'
    ];
    /* ====  End of SCOPES==== */
}
