<?php

namespace App\Models\checkouts\Transactions;

use App\Models\checkouts\orders\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'transactions';

    // Define the primary key if it's not 'id'
    protected $primaryKey = 'id';

    // Specify which attributes can be mass assigned
    protected $fillable = [
        'transaction_id',
        'amount',
        'order_id',
        'type',
        'payment_method',
        'status',
        'status_message',
        'last4Digits',
        'user_name',
        'user_email',
        'user_phone',
        'payment_type',
    ];

    // Specify the data types for attributes if necessary
    protected $casts = [
        'amount' => 'integer',
        'status' => 'integer',
    ];

    // Define relationships
    public function order(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
