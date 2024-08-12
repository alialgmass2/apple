<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'name',
        'email',
        'institution',
        'phone',
        'message',
    ];

    public function scopeList($query)
    {
        return $query->with('role:id,' . toLocale('name'))->latest();
    }

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    /* ====  End of REALTIONS==== */
}
