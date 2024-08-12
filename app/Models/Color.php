<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'color_name',
        'color_code',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdownColor($query)
    {
        return $query->select('id', 'color_code');
    }

    public function scopeList($query)
    {
        return $query->select('id', 'color_code', 'color_name');
    }


    public function scopeListDropdown($query)
    {
        return $query->select('id', 'color_code');
    }

    /* ====  End of SCOPES==== */


}
