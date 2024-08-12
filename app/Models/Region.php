<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'name_en',
        'name_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdown($query)
    {
        return $query->select('id', toLocale('name'));
    }

    public function scopeList($query)
    {
        return $query->select('id', toLocale('name'))->latest();
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       RELATIONS Section            =
    =============================================*/

    public function cities()
    {
        return $this->hasMany(City::class);
    }

    public function organizations()
    {
        return $this->hasMany(Organization::class);
    }

    public function registerSteps()
    {
        return $this->hasMany(RegisterStep::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    /* ====  End of RELATIONS==== */
}
