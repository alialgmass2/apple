<?php

namespace App\Models;

use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory, Translate;
    protected $fillable = [
        'category_id',
        'name_en',
        'name_ar',
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeListDropdownByCategoryId($query, $categoryId)
    {
        return $query->select('id', 'category_id', toLocale('name'))->where('category_id', $categoryId);
    }

    public function scopeList($query)
    {
        return $query->select('id', 'category_id', toLocale('name'))->with('category:id,' . toLocale('name'))->latest();
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       REALTIONS Section            =
    =============================================*/

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function products()
    {
        return $this->hasMany(product::class);
    }

    /* ====  End of REALTIONS==== */

}
