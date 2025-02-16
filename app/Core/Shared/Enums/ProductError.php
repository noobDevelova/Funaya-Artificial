<?php

namespace App\Core\Shared\Enums;

enum ProductError: string
{
    case PRODUCT_EXISTS = 'Product has already exists.';
    case PRODUCT_NOT_FOUND = 'Product is not found.';
    case PRODUCT_INSERT_FAILED = 'Product insertion has failed.';
    case PRODUCT_READ_FAILED = 'Product read has failed.';
    case PRODUCT_NOT_ACTIVE = 'Product is not active.';
    case PRODUCT_STILL_ACTIVE = 'Product is still active.';
    case PRODUCT_OUT_OF_STOCK = 'Product is out of stock.';
}
