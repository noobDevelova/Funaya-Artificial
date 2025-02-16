<?php

namespace App\Core\Shared\Enums;

enum AuthError: string
{
    case ACCOUNT_NOT_FOUND = 'Account not found. Please check your email.';
    case INVALID_PASSWORD = 'Invalid password. Please try again.';
    case ACCOUNT_NOT_ACTIVE = 'Account is not active. Please contact the administrator.';
}
