<?php

namespace App\Enums;

enum MessageStatus: int
{
    case None = 0;
    case SENT = 1;
    case CHARACTER_LIMIT_EXCEEDED = 2;
    case FAILED = 3;
}
