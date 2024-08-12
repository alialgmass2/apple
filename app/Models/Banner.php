<?php

namespace App\Models;

use App\Traits\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
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
