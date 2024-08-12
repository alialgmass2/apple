<?php

namespace App\Enums;

use App\Traits\InteractWithEnum;

enum OrderStatus : string
{
    use InteractWithEnum;
    case ORDER_PLACED = 'ORDER_PLACED';
    case IN_PROGRESS = 'IN_PROGRESS';
    case SHIPPED = 'SHIPPED';
    case OUT_FOR_DELIVERY = 'OUT_FOR_DELIVERY';
    case DELIVERED = 'DELIVERED';
    
    case CANCELLED = 'CANCELLED';
}
