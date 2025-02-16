<?php

namespace App\Core\Shared\Enums;

enum PurchaseError: string
{
    case PURCHASE_PRODUCT_NOT_FOUND = 'Product For Purchase Not Found';

    case PURHASE_FAILED = 'Failed Inserting Purchase Data';
}
