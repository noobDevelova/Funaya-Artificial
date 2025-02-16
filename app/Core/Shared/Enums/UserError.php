<?php

namespace App\Core\Shared\Enums;

enum UserError: string
{
    case USER_ALREADY_EXISTS = 'User Is Already Exists';
    case USER_NOT_FOUND = 'User Not Found';
}
