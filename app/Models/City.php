<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'region_id',
        'name_en',
        'name_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdownByRegionId($query, $regionId)
    {
        return $query->select('id', 'region_id', toLocale('name'))->where('region_id', $regionId);
    }

    public function scopeList($query)
    {
        return $query->select('id', 'region_id', toLocale('name'))->with('region:id,'. toLocale('name'))->latest();
    }


    public function scopeListDropdown($query)
    {
        return $query->select('id', toLocale('name'));
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function region()
    {
        return $this->belongsTo(Region::class)->withDefault();
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /* ====  End of REALTIONS==== */

}
