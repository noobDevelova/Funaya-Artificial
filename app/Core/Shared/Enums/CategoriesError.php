<?php

namespace App\Core\Shared\Enums;

enum CategoriesError: string
{
    case CATEGORIES_ALREADY_EXISTS = 'Categories Is Already Exists.';
    case CATEGORIES_NOT_FOUND = 'Categories Did Not Exists.';
    case CATEGORIES_ID_UNDEFINED = 'Categories ID Undefined';
    case CATEGORIES_SLUG_UNDEFINED = 'Categories Slug Undefined';
}
