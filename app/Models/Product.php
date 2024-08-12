<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{

    use HasFactory, Translate, Media;

    protected $fillable = [
        'category_id',
        'sub_category_id',
        'title_en',
        'title_ar',
        'sub_title_en',
        'sub_title_ar',
        'description_en',
        'description_ar',
        'features_ar',
        'features_en',
        'legal_ar',
        'legal_en',
        'technical_specifications_ar',
        'technical_specifications_en',
        'specifications_ar',
        'specifications_en',
        'links',
        'video_ar',
        'video_en',
        'price',
        'discount',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListAdmin($query, $categoryId)
    {
        return $query->select('id', 'category_id', 'sub_category_id', toLocale('title'), 'price', 'links', 'discount', toLocale('description'),
            toLocale('features'), toLocale('video'), toLocale('specifications'), toLocale('legal'), toLocale('technical_specifications'))->with('category', 'subCategory', 'images')->when($categoryId != '', fn($query) => $query->where('category_id', $categoryId))->latest();
    }
    public function scopeListAdminDiscount($query)
    {
        return $query->select('id', 'category_id', 'sub_category_id', toLocale('title'), 'price')->with('category', 'subCategory', 'images','customDiscount')->latest();
    }

    public function scopeList($query)
    {
        // return $query->select('id', toLocale('title'), 'price', 'discount', toLocale('description'), toLocale('features'))->with('images')->latest();
        return $query->select('id', toLocale('title'),toLocale('sub_title'), 'price', 'links', 'discount', toLocale('description'), toLocale('features'), toLocale('specifications'), toLocale('legal'), toLocale('technical_specifications'))->with('images')->orderBy('id','desc');
    }
    public function scopeDetails($query, $productId)
    {
        return $query->select('id', 'category_id', 'links', 'sub_category_id', toLocale('title'),toLocale('sub_title'), 'price', 'discount', toLocale('description'), toLocale('features'), toLocale('specifications'), toLocale('legal'), toLocale('technical_specifications'))->with('images', 'category', 'subCategory')->where('id', $productId);
    }

    public function scopeDropdownList($query,$cat_id)
    {
        return $query->select('id',toLocale('title'))->where('category_id',$cat_id);
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class)->withDefault();
    }

    public function customDiscount():HasMany
    {
        return $this->hasMany(OrganizationDiscount::class);
    }

    public function howTos()
    {
        return $this->hasMany(HowTo::class);
    }

    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }

    /* ====  End of REALTIONS==== */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public  function images(){
        return $this->morphOne(Image::class,'imageable');
    }
    protected $casts = [
        'links' => 'array',
    ];

}
