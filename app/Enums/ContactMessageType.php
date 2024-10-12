<?php

namespace App\Enums;

enum ContactMessageType:int
{
    case COMPLAINT = 1;
    case SUGGESTION = 2;
    case INQUIRY = 3;
}
