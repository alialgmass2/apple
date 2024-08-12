<?php

namespace App\Models;

use App\Traits\Media;
use App\Traits\Translate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    use HasFactory, Translate, Media;

    protected $fillable = [
        'name_en',
        'name_ar',
        'image',
        'order'
    ];

    /*=============================================
    =       SCOPES Section            =
    =============================================*/

    public function scopeList($query)
    {
        return $query->select('id', toLocale('name'))->latest();
    }

    public function scopeDetails($query, $id)
    {
        return $query->select('id', toLocale('name'))->where('id', $id);
    }

    /* ====  End of SCOPES==== */

    /*=============================================
    =       RELATIONS Section            =
    =============================================*/

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    public function products()
    {
        return $this->hasMany(product::class);
    }
    public function getImageUrlAttribute() :string{
        return  asset(Storage::url($this->image));

    }

    /* ====  End of RELATIONS==== */

}
