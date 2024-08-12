<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory, Translate , Media;
    protected $fillable = [
        'title_en',
        'title_ar',
        'brief_en',
        'brief_ar',
        'discription_en',
        'discription_ar',
        'start_date',
        'end_date',
        'percent',
        'status',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdownByRegionId($query, $regionId)
    {
        return $query->select('id', 'start_date', 'end_date', 'percent', toLocale('title'), toLocale('discription'), toLocale('brief'));
    }

    public function scopeList($query)
    {
        return $query->select('id', 'start_date', 'end_date', 'percent', toLocale('title'), toLocale('discription'), toLocale('brief'));
    }


    public function scopeListDropdown($query)
    {
        return $query->select('id', toLocale('title'));
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/
    public  function images(){
        return $this->morphOne(Image::class,'imageable');
    }
    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];
}
