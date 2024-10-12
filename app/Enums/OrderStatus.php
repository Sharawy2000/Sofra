<?php

namespace App\Enums;

enum OrderStatus:int
{
    case PENDING = 0;
    case ACCEPTED = 1;
    case REJECTED = 2;
    case DELIVERED = 3;
    case CANCELLED = 4;
}
