<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders_old';

    protected $fillable = [
        'user_id',
        'organization_id',
        'product_id',
        'deliver_type',
        'address',
        'phone',
        'is_with_discount',
        'price',
        'city_id',
        'district',
        'short_national_id',
        'zip_code',
        'order_details',
    ];

    protected $casts = [
        'status' => OrderStatus::class,
        'order_details' => 'array'
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->with('user', 'organization:id,' . toLocale('name'), 'product:id,price,' . toLocale('title'))->latest();
    }

    public function scopeListByUserId($query, $authUserId)
    {
        return $query->where('user_id', $authUserId)->with('user', 'organization:id,' . toLocale('name'), 'product:id,price,' . toLocale('title'))->latest();
    }
    public function scopeDetailsByUserId($query, $orderId, $authUserId)
    {
        return $query->where('id', $orderId)->where('user_id', $authUserId)->with('user', 'organization:id,' . toLocale('name'), 'product:id,price,' . toLocale('title'));
    }
    public function scopeOrderPaid($query){
        return $query->where(function ($q){
            $q->where('method', '!=', 'cash')
                ->where('status', 0);
        })->orWhere('method', 'cash');
    }

    /* ====  End of SCOPES==== */

/*=============================================
=       REALTIONS Section            =
=============================================*/
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class)->withDefault();
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    public function city()
    {
        return $this->belongsTo(City::class)->withDefault();
    }


/* ====  End of REALTIONS==== */

}
