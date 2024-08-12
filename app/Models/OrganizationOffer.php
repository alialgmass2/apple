<?php

namespace App\Models;


use App\Traits\HasModal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class OrganizationOffer extends Model
{
    use HasModal;
    protected $table = 'organization_offers';
    protected $fillable = [
        'offer_id',
        'organization_id',
    ];
    public $timestamps = true;
    public function offer():BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id', 'id');
    }
    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class,'organization_id','id');
    }
    public function scopeListAdmin($query, $organizationId)
    {
        return $query->select('id', 'offer_id', 'organization_id')->with('organization', 'offer')->when($organizationId != '', fn($query) => $query->where('organization_id', $organizationId))->latest();
    }
    public function ProductOffer ():HasMany
    {
        return $this->hasMany(ProductOffer::class, 'organization_offer_id', 'id');
    }
    public function scopeCategories($query)
    {
        $category = [];
        foreach ($query as $category) {
            $category[] = $category->ProductOffer()->get();
        }
        return $category;
    }

    /* ====  End of ACCESSORS==== */

}
