<?php

namespace App\Enums;

use App\Traits\InteractWithEnum;

enum DeliverType : string
{
    use InteractWithEnum;
    case DELIVER_TO_HOME = 'DELIVER_TO_HOME';
    case DELIVER_TO_ORGANIZATION = 'DELIVER_TO_ORGANIZATION';
}
