<?php

namespace App\Enums;

enum VacationStatusEnum: int
{
    case VERIFIED = 1;

    case PENDING = 2;

    case REJECTED = 3;
}
