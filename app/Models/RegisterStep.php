<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RegisterStep extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'user_type',
        'region_id',
        'city_id',
        'education_level_id',
        'role_id',
        'organization_id',
        'email',
        'password',
        'otp',
        'step',
        'password_without_hash',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeByIpAddress($query, $ip)
    {
        return $query->where('ip', $ip);
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function region()
    {
        return $this->belongsTo(Region::class)->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class)->withDefault();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->withDefault();
    }

    /* ====  End of REALTIONS==== */
    /**
     * Interact with the user's first name.
     */
    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value),
        );
    }
}
