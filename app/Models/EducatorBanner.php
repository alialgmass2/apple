<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducatorBanner extends Model
{

    use HasFactory, Media;

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->with('images')->latest();
    }

    /* ====  End of SCOPES==== */

}
