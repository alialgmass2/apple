<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\checkouts\Address;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use App\Models\checkouts\catrs\Cart;
use App\Models\checkouts\orders\Order;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_type',
        'region_id',
        'city_id',
        'education_level_id',
        'organization_id',
        'email',
        'password',
        'otp',
        'otp_verified',
        'forgot_password_otp',
        'is_forgot_password_otp_verfied',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /*=============================================
    =       scopes Section            =
    =============================================*/



    /* ====  End of scopes==== */

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

    public function role()
    {
        return $this->belongsTo(Role::class)->withDefault();
    }

    public function howToKnow():HasMany
    {
        return $this->hasMany(HowToKnow::class,'student_id','id');
    }

    // public function ordersOld()
    // {
    //     return $this->hasMany(Order::class);
    // }

    /* ====  End of REALTIONS==== */

    /*=============================================
    =       ENG ALI Section            =
    =============================================*/
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
public function address(){
    return $this->hasMany(Address::class);
}


    /* ====  End of ENG ALI==== */
}
