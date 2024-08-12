<?php

namespace App\Models\checkouts\orders;

use App\Models\checkouts\Address;
use App\Models\checkouts\PaymentTransaction;
use App\Models\orders\Coupon;
use App\Models\checkouts\orders\OrderItems;
use App\Models\orders\OrderOptions;
use App\Models\User;

use App\Models\resturants\Restaurant;
use Carbon\Carbon;
use App\Events\NewOrderAdded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\chats\Room;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory , SoftDeletes;
    protected $table = "orders";
    protected $fillable = [
        'order_number',
        'user_id',
        'address_id',
        'payment_status',
        'payment_method',
        'payment_transaction_id',
        'subtotal',
        'total',
        'order_status',
        'order_details',

    ];

    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function getImagesAttribute()
    {
        $images = [];
        foreach ($this->items as $item) {
            $images[] = $item->product->images;
        }
        return $images;
    }
    public function scopeOrderPaid($query)
    {
        return $query->whereHas('payment_transaction', function ($q) {
                $q->whereNot([['method', '!=', 'cash'],['status','0']]);
        });
    }

    public function scopeListAdmin($query,$method ,$from ,$to,$organization,$transactionId)
    {
        $query = $query->where('payment_status' , '!=' , 0);
        if ($organization){
            $query->with('user')
                ->whereHas('user', function ($q)use($organization) {
                $q->where('organization_id',$organization);
            });
        }
        if ($transactionId) {
            $query->where('order_number', 'LIKE', '%' . $transactionId . '%');
        }
        if ($from != null && $to != null){
            return $query->with('payment_transaction')
                ->whereHas('payment_transaction', function ($q)use($method,$from,$to) {
                $q->whereNot([['method', '!=', 'cash'],['status','0']]);
                $method != 'all' ? $q->where('method', $method)->whereBetween('created_at', [$from ,$to]):$q->whereBetween('created_at', [$from ,$to]);
            });
        }else{
            return $query->with('payment_transaction')
                ->whereHas('payment_transaction', function ($q)use($method) {
                $method != 'all' ? $q->where('method', $method):$q;
            });
        }
    }

    public function ProductsNames($lang)
    {
        $names = [];
        foreach ($this->items as $item) {
            $names[] = $item->product['title_'.$lang];
        }
        return $names;
    }


    public function options()
    {
        return $this->hasMany(OrderOptions::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class,'address_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get created_at Attribute with carbon format
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M d, Y');
    }

    public function status()
    {
        if ($this->status == 'processing') {
            return "<span class='btn btn-warning btn-sm'>" . trans('common.processing') . "</span>";
        } elseif ($this->status == 'inTheWay') {
            return "<span class='btn btn-primary btn-sm'>" . trans('common.inTheWay') . "</span>";
        } elseif ($this->status == 'completed') {
            return "<span class='btn btn-success btn-sm'>" . trans('common.completed') . "</span>";
        } elseif ($this->status == 'cancelled') {
            return "<span class='btn btn-danger btn-sm'>" . trans('common.cancelled') . "</span>";
        }
    }
    public function room()
    {
        return $this->hasOne(Room::class);
    }

    public function payment_transaction():BelongsTo
    {
        return $this->belongsTo(PaymentTransaction::class);
    }
    protected $casts = [
        'order_details' => 'array'
    ];

}
