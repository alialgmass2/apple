<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HowTo extends Model
{
    use HasFactory,Translate;
    protected $fillable = [
        'product_id',
        'title_en',
        'title_ar',
        'text_en',
        'text_ar',
    ];


    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    /* ====  End of REALTIONS==== */
}
