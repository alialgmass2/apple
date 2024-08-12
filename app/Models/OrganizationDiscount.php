<?php

namespace App\Models;


use App\Traits\HasModal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganizationDiscount extends Model
{
    use HasModal;
    protected $table = 'organization_discounts';
    protected $fillable = [
        'product_id',
        'organization_id',
        'discount',
    ];
    public $timestamps = true;

    /* ====  End of ACCESSORS==== */

    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
