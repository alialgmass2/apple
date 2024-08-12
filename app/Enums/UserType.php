<?php

namespace App\Enums;

use App\Traits\InteractWithEnum;

enum UserType : string
{
    use InteractWithEnum;
    case TEACHER = 'TEACHER';
    case STUDENT = 'STUDENT';
}
