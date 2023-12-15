<?php

namespace App\Enums;

enum UserRoleEnum : int
{
    case ROOT_ADMIN = 1;

    case ADMIN = 2;

    case USER = 3;
}
