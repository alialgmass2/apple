<?php

namespace App\Models\checkouts;

use App\Models\City;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = [
        'user_id',
        'address',
        'fname',
        'lname',
        'phone',
        'country_code',
        'short_national_id',
        'zip_code',
        'type',
        'region_id',
        'city_id',
        'distracts'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', true);
    }

    public function scopeNotDefault($query)
    {
        return $query->where('is_default', false);
    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
    public function city(){
        return $this->belongsTo(City::class);
    }

}
