<?php

namespace App\Models\checkouts\catrs;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id' ,'quantity','color_code'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPriceAttribute(){
        return $this->product()->first()->price;
    }
    public function getColor(){
        $color=\App\Models\Color::find($this->color_code);
        return $color_code=$color?->color_code;
    }
}
