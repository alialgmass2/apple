<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $table = 'payment_transactions';

    protected $guarded = [];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/
    public function scopeListAdmin($query,$method ,$from ,$to)
    {
        $q = $query->list();
        if ($from != null && $to != null){
            return $method != 'all' ? $q->where('method', $method)->whereBetween('created_at', [$from ,$to]):$q->whereBetween('created_at', [$from ,$to]);
        }else{
            return $method != 'all' ? $q->where('method', $method):$q;
        }
    }
    public function scopeList($query)
    {
        return $query->whereNot([['method', '!=', 'cash'],['status','0']]);
    }
    /* ====  End of SCOPES==== */
    public function order():HasOne
    {
        return $this->hasOne(\App\Models\checkouts\orders\Order::class)->withDefault();
    }

}
