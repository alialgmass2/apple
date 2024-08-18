<?php

namespace App\Models\checkouts;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;
    protected $fillable=['amount','status','method','user_id','transaction_id','payment_id','last4Digits'];
}
