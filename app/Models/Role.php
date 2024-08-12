<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    use HasFactory, Translate;
    protected $fillable = [
        'name_en',
        'name_ar',
    ];
    protected $table = 'instractor_roles';
    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdown($query)
    {
        return $query->select('id', toLocale('name'));
    }
    public function scopeRegisterEducatorListDropdown($query)
    {
        return $query->where('name_en','!=','Student')->select('id', toLocale('name'));
    }

    public function scopeList($query)
    {
        return $query->select('id', toLocale('name'))->latest();
    }

    /* ====  End of SCOPES==== */
/*=============================================
=       RELTIONS Section            =;
=============================================*/
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    // public function organizations()
    // {
    //     return $this->hasMany(Organization::class);
    // }

    // public function registerSteps()
    // {
    //     return $this->hasMany(RegisterStep::class);
    // }

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }

/* ====  End of RELTIONS==== */

}
