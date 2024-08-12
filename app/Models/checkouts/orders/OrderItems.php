<?php

namespace App\Models\checkouts\orders;

use App\Models\orders\OrderOptions;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $fillable = [
        'order_id',
        'product_id',
        'price',
        'quantity',
        'total',
        'vat',
        'discount',
        'color_code'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function options()
    {
        return $this->hasMany(OrderOptions::class);
    }
    public function getColor(){
       return $this->color_code;

    }

}
