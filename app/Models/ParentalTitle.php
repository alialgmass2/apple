<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentalTitle extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'title_en',
        'title_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListAdmin($query)
    {
        return $query->select('id',toLocale('title'))->latest();
    }
    public function scopeList($query)
    {
        return $query->select('id',toLocale('title'));
    }

    /* ====  End of SCOPES==== */
}
