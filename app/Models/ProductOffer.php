<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductOffer extends Model
{

    use HasFactory, Translate, Media;

    protected $fillable = [
        'organization_offer_id',
        'product_id',
        'offer_id',
    ];

    public function scopeCategories($query)
    {
        foreach ($query->toArray() as $product) {
            $category[] = $product->product()->get();
        }
        return $category;
    }

    public function organization_offer():BelongsTo
    {
        return $this->belongsTo(OrganizationOffer::class,'organization_offer_id','id');
    }
    public function product():BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function offer():BelongsTo
    {
        return $this->belongsTo(Offer::class,'offer_id','id');
    }

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

}
