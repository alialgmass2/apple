<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory, Translate, Media;
    protected $fillable = [
        'education_level_id',
        'region_id',
        'city_id',
        'shipment_city',
        'name_en',
        'name_ar',
        'domain',
        'email',
        'password',
        'discount',
        'delivery_price',
        'max_order_number',
        'address',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdownByEducationLevelId($query, $educationLevelId)
    {
        return $query->select('id', 'education_level_id', 'domain', toLocale('name'))->where('education_level_id', $educationLevelId);
    }

    public function scopeList($query)
    {
        return $query->select('id', 'education_level_id', 'shipment_city', 'region_id', 'city_id', 'domain', toLocale('name'))->with('images', 'educationLevel:id,' . toLocale('name'), 'region:id,' . toLocale('name'), 'city:id,' . toLocale('name'))->latest();
    }

    public function scopeListDropown($query)
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

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class)->withDefault();
    }

    public function registerSteps()
    {
        return $this->hasMany(RegisterStep::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    /* ====  End of REALTIONS==== */

    /*=============================================
    =       MUTETORS Section            =
    =============================================*/

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => bcrypt($value),
        );
    }
    /* ====  End of MUTETORS==== */

    /*=============================================
    =       ACCESSORS Section            =
    =============================================*/

    public function discountView(): Attribute
    {
        return new Attribute(
            get: fn() => '% ' . $this->discount
        );
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function offers()
    {
        return $this->hasMany(OrganizationOffer::class);
    }

    /* ====  End of ACCESSORS==== */

}
