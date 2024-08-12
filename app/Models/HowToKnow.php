<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HowToKnow extends Model
{
    protected $table = 'how_to_know';
    protected $fillable = [
        'student_id',
        'answer',
    ];


    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function student()
    {
        return $this->belongsTo(User::class,'student_id','id')->withDefault();
    }

    /* ====  End of REALTIONS==== */
}
