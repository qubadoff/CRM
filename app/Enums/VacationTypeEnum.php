<?php

namespace App\Enums;

enum VacationTypeEnum: int
{
    case DAY_OFF = 1;

    case SICK_LEAVE = 2;

    case WITHOUT_PERMISSION = 3;
}
